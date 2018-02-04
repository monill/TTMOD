<?php

namespace App\Controllers;

use App\Libs\BrowserDetection;
use App\Libs\Helper;
use App\Libs\Input;
use App\Libs\Torrent\Bencode;

class Announce extends Controller {

    public function __construct() {
        parent::__construct();
        // if (!$this->loggedIn()) {
        //     Redirect::to("/login");
        // }

    }

    public function __clone() {

    }

    public function index() {

        $browser = new BrowserDetection();

        echo $browser->getName();

        echo $browser->getUserAgent();

        //TODO
        //block direct access from browsers

    }

    public function passkey($passkey = "")
    {
        $uip = Helper::getIP();

        $infohash = Input::get("info_hash");
        $peerid = Input::get("peer_id");
        $ip = Input::get("ip");
        $port = (int)Input::get("port");
        $uploaded = (float)Input::get("uploaded");
        $downloaded = (float)Input::get("downloaded");
        $left = (float)Input::get("left");
        $event = Input::get("event");

        $no_peer_id = Input::get("no_peer_id");

        $browser = new BrowserDetection();
        $agent = $browser->getUserAgent();


        if (strlen($peerid) != 20) {
            $this->err("Invalid Peer ID.");
        }
        if (strlen($infohash) == 20) {
            $infohash = bin2hex($infohash);
        } elseif (strlen($infohash) != 40) {
            $this->err("Invalid info hash value");
        }
        if (strlen($passkey) != 32) {
            $this->err("Invalid passkey size (" . strlen($passkey) . " - $passkey)");
        }
        //Port check
        if (!$port || $port > 0xffff) {
            $this->err("Invalid port.");
        }

        $seeder = ($left == 0) ? "yes" : "no";

        if ($this->portBlackListed($port)) {
            $this->err("Port $port is blacklisted.");
        }

        $torrent = $this->db->select1("SELECT id, infohash, banned, freeleech, seeders + leechers AS numpeers, created_at, seeders, leechers, timescompleted FROM `torrents` WHERE `infohash` = :ihash", ["ihash" => $infohash]) or $this->err("Cannot Get Torrent Details");
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
            $this->err("Torrent not found on this tracker - hash = " . $infohash);
        }
        if ($torrent->banned == "yes") {
            $this->err("Torrent has been banned - hash = " . $infohash);
        }
        if ($torrent->numpeers > 50) {
            $limit = "ORDER BY RAND() LIMIT 50";
        } else {
            $limit = "";
        }

        $peer = $this->db->select("SELECT * FROM `peers` WHERE `torrent_id` = :tid $limit", ["tid" => $torrent->id]);

        $resp = "d8:completei" . $torrent->seeders . "e10:downloadedi" . $torrent->timescompleted . "e10:incompletei" . $torrent->leechers . "e";
        $resp .= $this->bencStr("interval") . "i" . 900 . "e" . $this->bencStr("min interval") . "i300e" . $this->bencStr("peers");

        unset($self);

        while ($row = $peer) {
            if ($row->peer_id === $peerid) {
                $self = $row;
                continue;
            }

            $peers = "d" . $this->bencStr("ip") . $this->bencStr($row->ip);

            if (!$no_peer_id) {
                $peers .= $this->bencStr("peer id") . $this->bencStr($row->peer_id);
            }
            $peers .= $this->bencStr("port") . "i" . $row->port . "ee";

            $resp .=  "l{$peers}e";
            $resp .= "ee";
        }

        if ($seeder != "yes") {
            $query = $this->db->select("SELECT COUNT(DISTINCT torrent_id) FROM `peers` WHERE `userid` = :uid AND `seeder` = 'no'", ["uid" => $user->id]);
            $maxslot = $this->maxSlots($user->id);
            if (count($query) >= $maxslot) {
                $this->err("Maximum $maxslot Slot exceeded! You dont have any more download slots available, wait for 1 or more to finish then you can download this.");
            }
        }

        if (!isset($self))
        {
            if (true && true)
            {
                $datet = strtotime(Helper::dateTime());
                $created = $torrent->created_at;
                $gigs = $user->uploaded / (1024 * 1024 * 1024);
                $elapsed = floor(round($datet) - round($created) / 3600);
                $ratio = (($user->downloaded > 0) ? ($user->uploaded / $user->downloaded) : 1);

                if ($ratio == 0 && $gigs == 0) { // Minimum ratio || Minimum gigs
                    $wait = 24;  // Wait time in hours
                } elseif ($ratio < 0.50 || $gigs < 1) {
                    $wait = 23;
                } elseif ($ratio < 0.65 || $gigs < 3) {
                    $wait = 11;
                } elseif ($ratio <0.80 || $gigs < 5) {
                    $wait = 6;
                } elseif ($ratio < 0.95 || $gigs < 7) {
                    $wait = 2;
                } else {
                    $wait = 0;
                }

                if ($elapsed < $wait) {
                    $this->err("Wait Time (" . ($wait - $elapsed) . " hours) Visit the forum for more info.");
                }
            }
            $sockets = fsockopen($ip, $port, $errno,$errstr, 5);
            if (!$sockets) {
                $connectable = "no";
            } else {
                $connectable = "yes";
            }
            fclose($sockets);

        } else {
            $upthis = max(0, $uploaded - $self["uploaded"]);
            $downthis = max(0, $downloaded - $self["downloaded"]);

            if (($upthis > 0 || $downthis) && $user->id) {
                if ($torrent->freeleech == "yes") {
                    $this->db->update('users', [
                        'uploaded' => "uploaded + $upthis"
                    ], "`id` = :id", ["id" => $user->id]);
                } else {
                    $this->db->update('users', [
                        'uploaded' => "uploaded + $upthis",
                        'downloaded' => "downloaded + $downthis"
                    ], "`id` = :id", ["id" => $user->id]) or $this->err("Tracker error: Unable to update stats");
                }
            }
        }

        ////////////////// NOW WE DO THE TRACKER EVENT UPDATES ///////////////////
        if ($event == "stopped") {
            $stopped = $this->db->delete('peers', "`torrent_id` = :tid AND `peer_id` = :pid", ["tid" => $torrent->id, "pid" => $peerid]);
            if (count($stopped)) {
                if ($self["seeder"] == "yes") {
                    $updateset = "seeders = seeders - 1";
                } else {
                    $updateset = "leechers = leechers - 1";
                }
            }
        }

        if ($event == "completed") { // UPDATE "COMPLETED" EVENT
            $updateset = "timescompleted = timescompleted + 1";

            $this->db->insert('completes', [
                'user_id' => $user->id,
                'torrent_id' => $torrent->id,
                'created_at' => Helper::dateTime()
            ]);
        } //END COMPLETED

        if (isset($self)) // NO EVENT? THEN WE MUST BE A NEW PEER OR ARE NOW SEEDING A COMPLETED TORRENT
        {
            $atualiza = $this->db->update('peers', [
                'ip' => $ip,
                'passkey' => $passkey,
                'port' => $port,
                'uploaded' => $uploaded,
                'downloaded' => $downloaded,
                'togo' => $left,
                'lastaction' => Helper::dateTime(),
                'client' => $agent,
                'seeder' => $seeder
            ], "`torrent_id` = :tid AND `peer_id` = :pid", [
                "tid" => $torrent->id, "pid" => $peerid
            ]);

            if (count($atualiza) && $self['seeder'] != $seeder) {
                if ($seeder == 'yes') {
                    $updateset = "seeders = seeders + 1";
                    $updateset = "leechers = leechers - 1";
                } else {
                    $updateset = "seeders = seeders - 1";
                    $updateset = "leechers = leechers + 1";
                }
            }
        } else {

            $ret = $this->db->insert('peers', [
                'connectable' => $connectable,
                'torrent_id' => $torrent->id,
                'peer_id' => $peerid,
                'ip' => $ip,
                'passkey' => $passkey,
                'port' => $port,
                'uploaded' => $uploaded,
                'downloaded' => $downloaded,
                'togo' => $left,
                'started' => Helper::dateTime(),
                'lastaction' => Helper::dateTime(),
                'seeder' => $seeder,
                'userid' => $user->id,
                'client' => $agent
            ]);

            if ($ret) {
                if ($seeder == "yes") {
                    $updateset = "seeders = seeders + 1";
                } else {
                    $updateset = "leechers = leechers + 1";
                }
            }
        }
        //////////////////    END TRACKER EVENT UPDATES ///////////////////

        // FILL $SELF WITH DETAILS FROM PEERS TABLE (CONNECTING PEERS DETAILS)
        if (!isset($self))
        {
            $valid = $this->db->select("SELECT COUNT(*) FROM `peers` WHERE `torrent_id` = :tid AND `passkey` = :pkey", ["tid" => $torrent->id, "pkey" => $passkey]);

           if ($valid >= 1 && $seeder != "no") {
               $this->err("Connection limit exceeded! You may only leech from one location at a time.");
           }
           if ($valid >= 3 && $seeder == "yes") {
               $this->err("Connection limit exceeded!");
           }
        }

        // SEEDED, LETS MAKE IT VISIBLE THEN
        if ($seeder == "yes") {
            if ($torrent->banned != "yes") {
                $updateset = "visible = "yes"";
            }
            $updateset = "lastaction = '" . Helper::dateTime() . "'";
        }

        // NOW WE UPDATE THE TORRENT AS PER ABOVE
        //TODO
        //fix this
//        if (count($updateset)) {
//            $this->db->update('torrents', [
//                join(",", $updateset)
//            ], "`id` = :id", ["id" => $torrent->id]) or $this->err("Tracker error: Unable to update torrent");
//        }

        // NOW BENC THE DATA AND SEND TO CLIENT???
        return Bencode::encode($this->bencRespRaw($resp));
    }

    public function bencRespRaw($value)
    {
        header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
        header("Content-Type: text/plain");
        header("Pragma: no-cache");
        print $value;
        exit();
    }

    public function bencStr($msg)
    {
        return strlen($msg) . ":$msg";
    }

    public function err($msg)
    {
        return $this->bencRespRaw("d" . $this->bencStr("failure reason") . $this->bencStr($msg) . "e");
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
            $maxslot = (int)$user->maxslots;
        }
        return $maxslot;
    }

}
