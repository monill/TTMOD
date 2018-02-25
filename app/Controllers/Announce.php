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

        $this->checkRequestType();

        // Standard Information Fields
        $event = Input::get("event");
        $hash = Input::get("info_hash");
        $peer_id = Input::get("peer_id");
        $md5_peer_id = md5($peer_id);

        $ip = Helper::getIP();

        $port = (int)Input::get("port");
        $left = (float)Input::get("left");
        $uploaded = (float)Input::get("uploaded");
        $real_uploaded = $uploaded;
        $downloaded = (float)Input::get("downloaded");
        $real_downloaded = $downloaded;

        //Extra Information Fields
        $no_peer_id = Input::get("no_peer_id");
        $compact = (Input::get("compact") && Input::get("compact") == 1) ? true : false;

        $browser = new BrowserDetection();
        $agent = $browser->getUserAgent();

        $events = array('started', 'stopped', 'completed', 'paused');
        if (!in_array($_GET['event'], $events)) {
            $this->err("Invalid event.");
        }

//        if (strlen($peer_id) != 20) {
//            $this->err("Invalid peerid: peerid is not 20 bytes long.");
//        }
        if (strlen($hash) != 40) {
            $this->err("Invalid info hash value");
        }
        if (strlen($passkey) != 32) {
            $this->err("Invalid passkey size (" . strlen($passkey) . " - $passkey)");
        }
        //Port check
        if (!$port || $port > 0xffff) {
            $this->err("Invalid port.");
        }

        if ($this->portBlackListed($port)) {
            $this->err("Port {$port} is Blacklisted.");
        }

        $torrent = $this->db->select1("SELECT * FROM `torrents` WHERE `info_hash` = :hash", ["hash" => $hash]) or $this->err("Cannot Get Torrent Details");
        $user = $this->db->select1("SELECT * FROM `users` WHERE `passkey` = :passkey", ["passkey" => $passkey]) or $this->err("Cannot Get User Details");

        if (!$user) {
            $this->err("Passkey is invalid.");
        }
        if ($user->status != "confirmed") {
            $this->err("Your account is not activated.");
        }
        if ($user->banned == "yes") {
            $this->err("You are no longer welcome here.");
        }
        if (!$torrent) {
            $this->err("Torrent not found on this tracker - hash = " . $hash);
        }
        if ($torrent->banned == "yes") {
            $this->err("Torrent has been banned - hash = " . $hash);
        }

        if (!$compact) {
            $this->err("Your client doesn't support compact, please update your client");
        }

        $peers = $this->db->select("SELECT * FROM `torrent_peers` WHERE `torrent_id` = :tid LIMIT 100", ["tid" => $torrent->id]);
        $seeders = 0;
        $leechers = 0;

        foreach ($peers as $peer) {
            if ($peer->to_go > 0) {
                $leechers++;
            } else {
                $seeders++;
            }
        }

        if ($torrent->freeleeach = 'yes') {
            $mod_downloaded  = 0;
        } else {
            $mod_downloaded  = $downloaded;
        }

        $sockets = @fsockopen($ip, $port, $errno, $errstr, 2.5);
        if (!$sockets) {
            $connectable = "no";
        } else {
            $connectable = "yes";
            @fclose($sockets);
        }
        unset($sockets, $errno, $errstr);

        if ($event == 'started') {

            //Peer update
            $this->db->insert('torrent_peers', [
                'torrent_id' => $torrent->id,
                'peer_id' => $peer_id,
                'ip' => $ip,
                'port' => $port,
                'uploaded' => $real_uploaded,
                'downloaded' => $real_downloaded,
                'to_go' => $left,
                'seeder' => ($left == 0) ? "yes" : "no",
                'connectable' => $connectable,
                'client' => $agent,
                'user_id' => $user->id,
                'passkey' => $passkey,
                'started' => Helper::dateTime()
            ]);

            $this->db->update('torrents', [
                //'seeders' => $torrent->seeders + 1,
                'visible' => 'yes',
            ], "`id` = :tid", ["tid" => $torrent->id]);

        } elseif ($event == 'stopped') {

            //Peer update
            $this->db->update('torrent_peers', [
                'peer_id' => $peer_id,
                'ip' => $ip,
                'port' => $port,
                'uploaded' => $real_uploaded,
                'downloaded' => $real_downloaded,
                'to_go' => $left,
                'seeder' => ($left == 0) ? "yes" : "no",
                'connectable' => $connectable,
                'client' => $agent,
                'user_id' => $user->id,
                'lastaction' => Helper::dateTime()
            ], "`torrent_id` = :tid AND `peer_id` = :pid", ["tid" => $torrent->id, "pid" => $peer_id]);

            //User update
            $this->db->update('users', [
                'uploaded' => $user->uploaded + $real_uploaded,
                'downloaded' => $user->downloaded + $real_downloaded
            ], "`id` = :uid", ["uid" => $user->id]);

        } elseif ($event == 'completed') {

            //Peer update
            $this->db->update('torrent_peers', [
                'client' => $agent,
                'seeder' => ($left == 0) ? "yes" : "no",
                'uploaded' => $uploaded,
                'downloaded' => $mod_downloaded,
                'updated_at' => Helper::dateTime()
            ], "`torrent_id` = :tid", ["tid" => $torrent->id]);

            //User update
            $this->db->update('users', [
                'uploaded' => $user->uploaded + $real_uploaded,
                'downloaded' => $user->downloaded + $real_downloaded
            ], "`id` = :uid", ["uid" => $user->id]);

            //Torrent update
            $this->db->update('torrents', [
                'times_completed' => $torrent->times_completed + 1
            ], "`id` = :tid", ["tid" => $torrent->id]);

            //Torrent completes update
            $this->db->insert('torrent_completes', [
                'torrent_id' => $torrent->id,
                'user_id' => $user->id,
                'created_at' => Helper::dateTime()
            ]);

        }

        $res = "d5:files";
        $res .= "d20:" . hex2bin($torrent->info_hash);
        $res  = "d8:completei" . (int)$torrent->seeders;
        $res .= "e10:downloadedi" . (int)$torrent->times_completed;
        $res .= "e10:incompletei" . (int)$torrent->leechers;
        $res .= "e8:intervali" . (60 * 30);
        $res .= "e12:min intervali" . (60 * 15);
        $res .= "e5:peers";

        while ($peers) {
            //$Peer = "";
            if ($peer_id === $peers->peer_id) {
                continue;
            }
            $Peer = "d" . benc_str("ip") . benc_str($peers->ip);

            if (!$no_peer_id) {
                $Peer .= benc_str("peer id") . benc_str($peers->peer_id);
            }
            $Peer .= benc_str("port") . "i" . $peers->port . "ee";
        }
        $res .= "l{$Peer}e";
        $res .= "ee";

//        $res = [];
//        $res['infohash'] = $torrent->info_hash;
//        $res['complete'] = (int)$torrent->seeders;
//        $res['downloaded'] = (int)$torrent->times_completed;
//        $res['incomplete'] = (int)$torrent->leechers;
//        $res['interval'] = (60 * 20);
//        $res['min interval'] = (60 * 10);
//        $res['peers'] = $this->givePeers($peers, $compact, $no_peer_id);

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
        return strlen($msg) . ":{$msg}e";
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
