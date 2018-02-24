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

//    public function passkey($passkey = "")
//    {
//        $uip = Helper::getIP();
//
//        $infohash = Input::get("info_hash");
//        $peerid = Input::get("peer_id");
//        $ip = Input::get("ip");
//        $port = (int)Input::get("port");
//        $uploaded = (float)Input::get("uploaded");
//        $downloaded = (float)Input::get("downloaded");
//        $left = (float)Input::get("left");
//        $event = Input::get("event");
//
//        $no_peer_id = Input::get("no_peer_id");
//
//        $browser = new BrowserDetection();
//        $agent = $browser->getUserAgent();
//
//        if (strlen($peerid) != 20) {
//            $this->err("Invalid Peer ID.");
//        }
//        if (strlen($infohash) == 20) {
//            $infohash = bin2hex($infohash);
//        } elseif (strlen($infohash) != 40) {
//            $this->err("Invalid info hash value");
//        }
//        if (strlen($passkey) != 32) {
//            $this->err("Invalid passkey size (" . strlen($passkey) . " - $passkey)");
//        }
//        //Port check
//        if (!$port || $port > 0xffff) {
//            $this->err("Invalid port.");
//        }
//
//        $seeder = ($left == 0) ? "yes" : "no";
//
//        if ($this->portBlackListed($port)) {
//            $this->err("Port $port is blacklisted.");
//        }
//
//        $torrent = $this->db->select1("SELECT id, info_hash, banned, freeleech, seeders + leechers AS numpeers, created_at, seeders, leechers, times_completed FROM `torrents` WHERE `info_hash` = :ihash", ["ihash" => $infohash]) or $this->err("Cannot Get Torrent Details");
//        $user = $this->db->select1("SELECT * FROM `users` WHERE `passkey` = :passkey LIMIT 1", ["passkey" => $passkey]) or $this->err("Cannot Get User Details");
//
//        if (!$user) {
//            $this->err("Passkey is invalid.");
//        }
//        if ($user->status != "confirmed") {
//            $this->err("Your account is not activated.");
//        }
//        if ($user->banned == "yes") {
//            $this->err("You are no longer welcome here.");
//        }
//        if (!$torrent) {
//            $this->err("Torrent not found on this tracker - hash = " . $infohash);
//        }
//        if ($torrent->banned == "yes") {
//            $this->err("Torrent has been banned - hash = " . $infohash);
//        }
//        if ($torrent->numpeers > 50) {
//            $limit = "ORDER BY RAND() LIMIT 50";
//        } else {
//            $limit = "";
//        }
//
//        $peer = $this->db->select1("SELECT * FROM `torrent_peers` WHERE `torrent_id` = :tid $limit", ["tid" => $torrent->id]);
//
//        $res = "d8:completei" . $torrent->seeders . "e10:downloadedi" . $torrent->times_completed . "e10:incompletei" . $torrent->leechers . "e";
//        $res .= $this->bencStr("interval") . "i" . 900 . "e" . $this->bencStr("min interval") . "i300e" . $this->bencStr("peers");
//
//        unset($self);
//
//        while ($row = $peer) {
//            if ($row->peer_id === $peerid) {
//                $self = $row;
//                continue;
//            }
//
//            $peers = "d" . $this->bencStr("ip") . $this->bencStr($row->ip);
//
//            if (!$no_peer_id) {
//                $peers .= $this->bencStr("peer id") . $this->bencStr($row->peer_id);
//            }
//            $peers .= $this->bencStr("port") . "i" . $row->port . "ee";
//
//            $res .=  "l{$peers}e";
//            $res .= "ee";
//        }
//
//        if ($seeder != "yes") {
//            $query = $this->db->select("SELECT COUNT(DISTINCT torrent_id) FROM `torrent_peers` WHERE `user_id` = :uid AND `seeder` = 'no'", ["uid" => $user->id]);
//            $maxslot = $this->maxSlots($user->id);
//            if (count($query) >= $maxslot) {
//                $this->err("Maximum $maxslot Slot exceeded! You dont have any more download slots available, wait for 1 or more to finish then you can download this.");
//            }
//        }
//
//        if (!isset($self))
//        {
//            if (true && true)
//            {
//                $datet = strtotime(Helper::dateTime());
//                $created = $torrent->created_at;
//                $gigs = $user->uploaded / (1024 * 1024 * 1024);
//                $elapsed = floor(round($datet) - round($created) / 3600);
//                $ratio = (($user->downloaded > 0) ? ($user->uploaded / $user->downloaded) : 1);
//
//                if ($ratio == 0 && $gigs == 0) { // Minimum ratio || Minimum gigs
//                    $wait = 24;  // Wait time in hours
//                } elseif ($ratio < 0.50 || $gigs < 1) {
//                    $wait = 23;
//                } elseif ($ratio < 0.65 || $gigs < 3) {
//                    $wait = 11;
//                } elseif ($ratio <0.80 || $gigs < 5) {
//                    $wait = 6;
//                } elseif ($ratio < 0.95 || $gigs < 7) {
//                    $wait = 2;
//                } else {
//                    $wait = 0;
//                }
//
//                if ($elapsed < $wait) {
//                    $this->err("Wait Time (" . ($wait - $elapsed) . " hours) Visit the forum for more info.");
//                }
//            }
//            $sockets = fsockopen($ip, $port, $errno,$errstr, 5);
//            if (!$sockets) {
//                $connectable = "no";
//            } else {
//                $connectable = "yes";
//            }
//            fclose($sockets);
//
//        } else {
//            $upthis = max(0, $uploaded - $self["uploaded"]);
//            $downthis = max(0, $downloaded - $self["downloaded"]);
//
//            if (($upthis > 0 || $downthis) && $user->id) {
//                if ($torrent->freeleech == "yes") {
//                    $this->db->update('users', [
//                        'uploaded' => "uploaded + $upthis"
//                    ], "`id` = :id", ["id" => $user->id]);
//                } else {
//                    $this->db->update('users', [
//                        'uploaded' => "uploaded + $upthis",
//                        'downloaded' => "downloaded + $downthis"
//                    ], "`id` = :id", ["id" => $user->id]) or $this->err("Tracker error: Unable to update stats");
//                }
//            }
//        }
//
//        ////////////////// NOW WE DO THE TRACKER EVENT UPDATES ///////////////////
//        $updateset = array();
//
//        if ($event == "stopped") {
//            $stopped = $this->db->delete('torrent_peers', "`torrent_id` = :tid AND `peer_id` = :pid", ["tid" => $torrent->id, "pid" => $peerid]);
//            if (count($stopped)) {
//                if ($self["seeder"] == "yes") {
//                    $updateset[] = "seeders = seeders - 1";
//                } else {
//                    $updateset[] = "leechers = leechers - 1";
//                }
//            }
//        }
//
//        if ($event == "completed") { // UPDATE "COMPLETED" EVENT
//            $updateset[] = "times_completed = times_completed + 1";
//
//            $this->db->insert('torrent_completes', [
//                'user_id' => (int) $user->id,
//                'torrent_id' => (int) $torrent->id,
//                'created_at' => Helper::dateTime()
//            ]);
//        } //END COMPLETED
//
//        if (isset($self)) // NO EVENT? THEN WE MUST BE A NEW PEER OR ARE NOW SEEDING A COMPLETED TORRENT
//        {
//            $atualiza = $this->db->update('torrent_peers', [
//                'ip' => $ip,
//                'passkey' => $passkey,
//                'port' => $port,
//                'uploaded' => $uploaded,
//                'downloaded' => $downloaded,
//                'to_go' => $left,
//                'lastaction' => Helper::dateTime(),
//                'client' => $agent,
//                'seeder' => $seeder
//            ], "`torrent_id` = :tid AND `peer_id` = :pid", [
//                "tid" => $torrent->id, "pid" => $peerid
//            ]);
//
//            if (count($atualiza) && $self['seeder'] != $seeder) {
//                if ($seeder == 'yes') {
//                    $updateset[] = "seeders = seeders + 1";
//                    $updateset[] = "leechers = leechers - 1";
//                } else {
//                    $updateset[] = "seeders = seeders - 1";
//                    $updateset[] = "leechers = leechers + 1";
//                }
//            }
//        } else {
//
//            $ret = $this->db->insert('torrent_peers', [
//                'connectable' => $connectable,
//                'torrent_id' => $torrent->id,
//                'peer_id' => $peerid,
//                'ip' => $ip,
//                'passkey' => $passkey,
//                'port' => $port,
//                'uploaded' => $uploaded,
//                'downloaded' => $downloaded,
//                'to_go' => $left,
//                'started' => Helper::dateTime(),
//                'lastaction' => Helper::dateTime(),
//                'seeder' => $seeder,
//                'user_id' => $user->id,
//                'client' => $agent
//            ]);
//
//            if ($ret) {
//                if ($seeder == "yes") {
//                    $updateset[] = "seeders = seeders + 1";
//                } else {
//                    $updateset[] = "leechers = leechers + 1";
//                }
//            }
//        }
//        //////////////////    END TRACKER EVENT UPDATES ///////////////////
//
//        // FILL $SELF WITH DETAILS FROM torrent_peers TABLE (CONNECTING torrent_peers DETAILS)
//        if (!isset($self))
//        {
//            $valid = $this->db->select("SELECT COUNT(*) FROM `torrent_peers` WHERE `torrent_id` = :tid AND `passkey` = :pkey", ["tid" => $torrent->id, "pkey" => $passkey]);
//
//           if ($valid >= 1 && $seeder != "no") {
//               $this->err("Connection limit exceeded! You may only leech from one location at a time.");
//           }
//           if ($valid >= 3 && $seeder == "yes") {
//               $this->err("Connection limit exceeded!");
//           }
//        }
//
//        // SEEDED, LETS MAKE IT VISIBLE THEN
////        if ($seeder == "yes") {
////            if ($torrent->banned != "yes") {
////                $updateset[] = "visible" = 'yes';
////            }
////            $updateset[] = "lastaction = '" . Helper::dateTime() . "'";
////        }
//
//        // NOW WE UPDATE THE TORRENT AS PER ABOVE
//        //TODO
//        //fix this
////        if (count($updateset)) {
////            $this->db->prepare("UPDATE torrents SET " . join(",", $updateset) . " WHERE id = :tid") or $this->err("Tracker error: Unable to update torrent");
////            $this->db->execute(["tid" => $torrent->id]);
////        }
//
//        // NOW BENC THE DATA AND SEND TO CLIENT???
//        return Bencode::encode($this->bencRespRaw($res));
//    }


    public function passkey($passkey = '')
    {

        $this->checkRequestType();

        // Standard Information Fields
        $event = Input::get("event");
        $hash = bin2hex(Input::get("info_hash"));
        $peer_id = bin2hex(Input::get("peer_id"));
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
            $this->err("Port $port is blacklisted.");
        }

        $torrent = $this->db->select1("SELECT * FROM `torrents` WHERE `info_hash` = :hash LIMIT 1", ["hash" => $hash]) or $this->err("Cannot Get Torrent Details");
        $user = $this->db->select1("SELECT * FROM `users` WHERE `passkey` = :passkey LIMIT 1", ["passkey" => $passkey]) or $this->err("Cannot Get User Details");

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

            unset(
                $peer->id,
                $peer->torrent_id,
                $peer->peer_id,
                $peer->ip,
                $peer->port,
                $peer->uploaded,
                $peer->downloaded,
                $peer->to_go,
                $peer->seeder,
                $peer->connectable,
                $peer->client,
                $peer->user_id,
                $peer->passkey,
                $peer->started,
                $peer->lastaction
            );
        }

        if ($torrent->freeleeach = 'yes') {
            $mod_downloaded  = 0;
        } else {
            $mod_downloaded  = $downloaded;
        }

        $sockets = fsockopen($ip, $port, $errno, $errstr, 5);
        if (!$sockets) {
            $connectable = "no";
        } else {
            $connectable = "yes";
        }
        //fclose($sockets);

        if ($event == 'started')
        {
            //Peer update
            $this->db->insert('torrent_peers', [
                'torrent_id' => $torrent->id,
                'peer_id' => $md5_peer_id,
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
                'peer_id' => $md5_peer_id,
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
            ], "`torrent_id` = :tid AND `peer_id` = :pid", ["tid" => $torrent->id, "pid" => $md5_peer_id]);

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
        $res .= "d20:info_hashi". $torrent->info_hash;
        $res .= "d8:completei" . $seeders;
        $res .= "e10:incompletei" . $leechers;
        $res .= "e10downloadedi" . $torrent->times_completed;
        $res .= "e8intervali" . (60 * 45);
        $res .= "e12min intervali" . (60 * 30);
        $res .= "e" . $this->bencStr("peers") . $this->givePeers($peers, $compact, $no_peer_id);
        $res .= "e4:name" . strlen($torrent->filename) . ":" . $torrent->filename;
        $res .= "ee";

        //$data = Bencode::encode($res);
        return $this->bencRespRaw($res);
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
        return $this->bencRespRaw("d14:failure reason" . $this->bencStr($msg));
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
        if ($port >= 411 && $port <= 413) { //direct connect
            return true;
        }
        if ($port == 1214) { //kazaa
            return true;
        }
        if ($port >= 6346 && $port <= 6347) { // gnutella
            return true;
        }
        if ($port == 4662) { // emule
            return true;
        }
        if ($port == 6699) { // winmx
            return true;
        }
        return false;
    }

    public function bencInt($value)
    {
        return "i" . $value . "e";
    }

    public function maxSlots($userid)
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
        return $peers;
    }

}
