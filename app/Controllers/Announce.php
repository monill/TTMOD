<?php

namespace App\Controllers;

use App\Libs\BrowserDetection;
use App\Libs\Helper;
use App\Libs\Input;
use App\Libs\Torrent\Bencode;

class Announce extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    private function __clone() { }

    public function index()
    {

        $browser = new BrowserDetection();

        echo $browser->getName();
        echo "<br />";
        echo $browser->getUserAgent();

        //TODO
        //block direct access from browsers

    }

    public function passkey($passkey = '')
    {
//        $this->checkRequestType();

        // Standard Information Fields
        $event = Input::get("event");
        $ihash = Input::get("info_hash");
        $peer_id = Input::get("peer_id");

        $ip = Helper::getIP();

        $port = (int)Input::get("port");
        $left = (float)Input::get("left");
        $uploaded = (float)Input::get("uploaded");
        $downloaded = (float)Input::get("downloaded");

        //Extra Information Fields
        $no_peer_id = Input::get("no_peer_id");
        $compact = (Input::get("compact") && Input::get("compact") == 1) ? true : false;
        $numwant = Input::get("numwant") ? (int)Input::get("numwant") : 50;

        $seeder = ($left == 0) ? "yes" : "no";

        $browser = new BrowserDetection();
        $agent = $browser->getUserAgent();

//        $events = array('started', 'stopped', 'completed', 'paused');
//        if (!in_array($_GET['event'], $events)) {
//            $this->err("Invalid event.");
//        }

        //Peer_id lenght check
        if (strlen($peer_id) != 20) { $this->err("Invalid peerid: peerid is not 20 bytes long."); }
        //Info_hash lenght check
        if (strlen($ihash) != 40) { $this->err("Invalid info hash value."); }
        //Passkey lenght check
        if (strlen($passkey) != 32) { $this->err("Invalid passkey size (" . strlen($passkey) . " - {$passkey})"); }
        //Port check
        if (!$port || $port > 0xffff) { $this->err("Port is invalid."); }
        //Blacklist port check
        if ($this->portBlackListed($port)) { $this->err("Port {$port} is Blacklisted."); }

        $torrent = $this->db->select1("SELECT * FROM `torrents` WHERE `info_hash` = :hash", ["hash" => $ihash]) or $this->err("Cannot Get Torrent Details");

        $mod_downloaded = $torrent->freeleeach == 'yes' ? 0 : $downloaded;

        $user = $this->db->select1("SELECT * FROM `users` WHERE `passkey` = :passkey", ["passkey" => $passkey]) or $this->err("Cannot Get User Details");

        if (!$user) { $this->err("User is invalid."); }
        if ($user->status != "confirmed") { $this->err("Your account is not activated."); }
        if ($user->banned == "yes") { $this->err("You are no longer welcome here."); }
        if (!$torrent) { $this->err("Torrent not found on this tracker"); }
        if ($torrent->banned == "yes") { $this->err("Torrent has been banned"); }

        if (!$compact) { $this->err("Your client doesn't support compact, please update your client"); }

        $peers = $this->db->select("SELECT `peer_id`, `ip`, `port` FROM `torrent_peers` WHERE `torrent_id` = :tid LIMIT {$numwant}", ["tid" => $torrent->id]);

        $sockets = fsockopen($ip, $port, $errno, $errstr, 2.5);
        $connectable = !$sockets ? "no" : "yes";
        fclose($sockets);
        unset($sockets, $errno, $errstr);

        if ($event == 'started') {

            //Peer insert
            $this->db->insert('torrent_peers', [
                'torrent_id' => $torrent->id,
                'peer_id' => $peer_id,
                'ip' => $ip,
                'port' => $port,
                'uploaded' => $uploaded,
                'downloaded' => $downloaded,
                'to_go' => $left,
                'seeder' => $seeder,
                'connectable' => $connectable,
                'client' => $agent,
                'user_id' => $user->id,
                'passkey' => $passkey,
                'started' => Helper::dateTime()
            ]);

            $this->db->update('torrents', [
                'seeders' => $torrent->seeders + 1,
                'visible' => 'yes',
            ], "`id` = :tid", ["tid" => $torrent->id]);

        } elseif ($event == 'completed') {

            //Peer update
            $this->db->update('torrent_peers', [
                'client' => $agent,
                'seeder' => $seeder,
                'uploaded' => $uploaded,
                'downloaded' => $downloaded,
                'updated_at' => Helper::dateTime()
            ], "`torrent_id` = :tid", ["tid" => $torrent->id]);

            //User update
            $this->db->update('users', [
                'uploaded' => $user->uploaded + $uploaded,
                'downloaded' => $user->downloaded + $mod_downloaded
            ], "`id` = :uid", ["uid" => $user->id]);

            //Torrent update
            $this->db->update('torrents', [
                'times_completed' => $torrent->times_completed + 1
            ], "`id` = :tid", ["tid" => $torrent->id]);

            //Torrent completed increment
            $this->db->insert('torrent_completes', [
                'torrent_id' => $torrent->id,
                'user_id' => $user->id,
                'created_at' => Helper::dateTime()
            ]);

        } elseif ($event == 'stopped') {

            //Peer update
            $this->db->delete('torrent_peers', "`torrent_id` = :tid AND `peer_id` = :pid", ["tid" => $torrent->id, "pid" => $peer_id]);

            //User update
            $this->db->update('users', [
                'uploaded' => $user->uploaded + $uploaded,
                'downloaded' => $user->downloaded + $mod_downloaded
            ], "`id` = :uid", ["uid" => $user->id]);

        } else {

            $this->err("Some error");

        }

         $res = [
             'complete' => (int)$torrent->seeders,
             'downloaded' => (int)$torrent->times_completed,
             'incomplete' => (int)$torrent->leechers,
             'interval' => (60 * 20),
             'min interval' => (60 * 10),
             'peers' => $this->givePeers($peers, $compact, $no_peer_id)
         ];

         $data = \Rych\Bencode\Bencode::encode($res);

         return $this->bencRespRaw($data);
    }

    public function bencRespRaw($value)
    {
        ob_start();
        header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
        header("Content-Type: text/plain; charset=UTF-8");
        header("Pragma: no-cache");
        print $value;
        ob_end_flush();
        exit();
    }

    public function bencStr($msg)
    {
        return strlen($msg) . ":{$msg}";
    }

    public function err($msg)
    {
        return $this->bencRespRaw("d" . $this->bencStr("failure reason") . $this->bencStr($msg));
    }

    private function checkRequestType()
    {
        // Check Announce Request Method
        if ($_SERVER['REQUEST_METHOD'] != 'GET') {
            return $this->err("Invalid Request Type: Client Request Was Not A HTTP GET.");
        }
    }

    public function portBlackListed($port)
    {
        $blocked = [
            411,
            412,
            413,
            1214,
            4662,
            6346,
            6347,
            6699,
            6881,
            6882,
            6883,
            6884,
            6885,
            6886,
            6887,
            6889,
            6969,
            65535
        ];

        if (in_array($port, $blocked)) {
            return true;
        }
        return false;
    }

    private function maxSlots($userid)
    {
        $user = $this->db->select1("SELECT `id`, `warn`, `maxslots` FROM `users` WHERE `id` = :idd", ["idd" => $userid]);
        if ($user->warn == "yes") {
            $maxslot = 1;
        } else {
            $maxslot = (int) $user->maxslots;
        }
        return $maxslot;
    }

    private function givePeers($peers, $compact, $no_peer_id)
    {
        if ($compact) {
            $pcomp = "";
            foreach ($peers as $peer) {
                if (isset($peer->ip) && isset($peer->port)) {
                    $pcomp .= pack('Nn', ip2long($peer->ip), (int)$peer->port);
                }
            }
            return $pcomp;
        } elseif ($no_peer_id) {
            foreach ($peers as &$peer) {
                unset($peer->peer_id);
            }
            return $peers;
        } else {
            return $peers;
        }
    }

}
