<?php

function passkey($passkey = "")
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

    $torrent = $this->db->select1("SELECT id, info_hash, banned, freeleech, seeders + leechers AS numpeers, created_at, seeders, leechers, times_completed FROM `torrents` WHERE `info_hash` = :ihash", ["ihash" => $infohash]) or $this->err("Cannot Get Torrent Details");
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

    $peer = $this->db->select1("SELECT * FROM `torrent_peers` WHERE `torrent_id` = :tid $limit", ["tid" => $torrent->id]);

    $res = "d8:completei" . $torrent->seeders . "e10:downloadedi" . $torrent->times_completed . "e10:incompletei" . $torrent->leechers . "e";
    $res .= $this->bencStr("interval") . "i" . 900 . "e" . $this->bencStr("min interval") . "i300e" . $this->bencStr("peers");

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

        $res .=  "l{$peers}e";
        $res .= "ee";
    }

    if ($seeder != "yes") {
        $query = $this->db->select("SELECT COUNT(DISTINCT torrent_id) FROM `torrent_peers` WHERE `user_id` = :uid AND `seeder` = 'no'", ["uid" => $user->id]);
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
    $updateset = array();

    if ($event == "stopped") {
        $stopped = $this->db->delete('torrent_peers', "`torrent_id` = :tid AND `peer_id` = :pid", ["tid" => $torrent->id, "pid" => $peerid]);
        if (count($stopped)) {
            if ($self["seeder"] == "yes") {
                $updateset[] = "seeders = seeders - 1";
            } else {
                $updateset[] = "leechers = leechers - 1";
            }
        }
    }

    if ($event == "completed") { // UPDATE "COMPLETED" EVENT
        $updateset[] = "times_completed = times_completed + 1";

        $this->db->insert('torrent_completes', [
            'user_id' => (int) $user->id,
            'torrent_id' => (int) $torrent->id,
            'created_at' => Helper::dateTime()
        ]);
    } //END COMPLETED

    if (isset($self)) // NO EVENT? THEN WE MUST BE A NEW PEER OR ARE NOW SEEDING A COMPLETED TORRENT
    {
        $atualiza = $this->db->update('torrent_peers', [
            'ip' => $ip,
            'passkey' => $passkey,
            'port' => $port,
            'uploaded' => $uploaded,
            'downloaded' => $downloaded,
            'to_go' => $left,
            'lastaction' => Helper::dateTime(),
            'client' => $agent,
            'seeder' => $seeder
        ], "`torrent_id` = :tid AND `peer_id` = :pid", [
            "tid" => $torrent->id, "pid" => $peerid
        ]);

        if (count($atualiza) && $self['seeder'] != $seeder) {
            if ($seeder == 'yes') {
                $updateset[] = "seeders = seeders + 1";
                $updateset[] = "leechers = leechers - 1";
            } else {
                $updateset[] = "seeders = seeders - 1";
                $updateset[] = "leechers = leechers + 1";
            }
        }
    } else {

        $ret = $this->db->insert('torrent_peers', [
            'connectable' => $connectable,
            'torrent_id' => $torrent->id,
            'peer_id' => $peerid,
            'ip' => $ip,
            'passkey' => $passkey,
            'port' => $port,
            'uploaded' => $uploaded,
            'downloaded' => $downloaded,
            'to_go' => $left,
            'started' => Helper::dateTime(),
            'lastaction' => Helper::dateTime(),
            'seeder' => $seeder,
            'user_id' => $user->id,
            'client' => $agent
        ]);

        if ($ret) {
            if ($seeder == "yes") {
                $updateset[] = "seeders = seeders + 1";
            } else {
                $updateset[] = "leechers = leechers + 1";
            }
        }
    }
    //////////////////    END TRACKER EVENT UPDATES ///////////////////

    // FILL $SELF WITH DETAILS FROM torrent_peers TABLE (CONNECTING torrent_peers DETAILS)
    if (!isset($self))
    {
        $valid = $this->db->select("SELECT COUNT(*) FROM `torrent_peers` WHERE `torrent_id` = :tid AND `passkey` = :pkey", ["tid" => $torrent->id, "pkey" => $passkey]);

       if ($valid >= 1 && $seeder != "no") {
           $this->err("Connection limit exceeded! You may only leech from one location at a time.");
       }
       if ($valid >= 3 && $seeder == "yes") {
           $this->err("Connection limit exceeded!");
       }
    }

    // SEEDED, LETS MAKE IT VISIBLE THEN
//        if ($seeder == "yes") {
//            if ($torrent->banned != "yes") {
//                $updateset[] = "visible" = 'yes';
//            }
//            $updateset[] = "lastaction = '" . Helper::dateTime() . "'";
//        }

    // NOW WE UPDATE THE TORRENT AS PER ABOVE
    //TODO
    //fix this
//        if (count($updateset)) {
//            $this->db->prepare("UPDATE torrents SET " . join(",", $updateset) . " WHERE id = :tid") or $this->err("Tracker error: Unable to update torrent");
//            $this->db->execute(["tid" => $torrent->id]);
//        }

    // NOW BENC THE DATA AND SEND TO CLIENT???
    return Bencode::encode($this->bencRespRaw($res));
}
