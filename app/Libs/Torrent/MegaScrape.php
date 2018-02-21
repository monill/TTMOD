<?php

namespace App\Libs\Torrent;

use App\Libs\Database;
use App\Libs\Helper;
use App\Libs\Torrent\Exception\ScraperException;

class MegaScrape
{
    private $db;
    private $parse;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->parse = new Parse();
    }

    private function __clone() { }

    public function tor()
    {
        set_time_limit(15);
        // Rescrape torrents every x seconds. (Default: 2 days)
        $torr = $this->db->select("SELECT `id`, `info_hash`, `updated_at` FROM `torrents` WHERE `external` = 'yes' AND `updated_at` <= NOW() - INTERVAL 2 DAY ORDER BY id DESC LIMIT 10");

        foreach ($torr as $tor) {

            $updir = TUPLOAD . "$tor->id.torrent";

            $torInfo = $this->parse->torr("$updir");

            $announce = $torInfo[0];

            $annlist = array();

            if ($torInfo[6]) {
                foreach ($torInfo[6] as $ann) {
                    $annlist[] = $ann[0];
                }
            } else {
                $annlist = array($announce);
            }

            $seeders = $leechers = $downloaded = null;

            foreach ($annlist as $ann) {
                $tracker = explode("/", $ann);
                $path = array_pop($tracker);
                $oldpath = $path;
                $path = str_replace("announce", "scrape", $path);
                $tracker = implode("/", $tracker) . "/" . $path;

                if ($oldpath == $path) {
                    continue;
                }

                if (preg_match("/thepiratebay.org/i", $tracker) || preg_match("/prq.to/", $tracker)) {
                    $tracker = "http://tracker.openbittorrent.com/scrape";
                    //$openbittorrent_done = 1;
                }

                if (preg_match('/udp:\/\//', $tracker)) {
                    $udp = true;
                    try {
                        $timeout = 5;
                        $udp = new UdpScraper(); //$timeout
                        $stats = $udp->scrape($tracker, $tor->info_hash);

                        foreach ($stats as $idu => $scrape) {
                            $seeders += intval(strip_tags($scrape['seeders']));
                            $leechers += intval(strip_tags($scrape['leechers']));
                            $downloaded += intval(strip_tags($scrape['completed']));
                        }

                        $this->db->update('torrents', [
                            'times_completed' => $downloaded,
                            'leechers' => $leechers,
                            'seeders' => $seeders,
                            'visible' => 'yes',
                            'updated_at' => Helper::dateTime()
                        ], "`id` = :id", ["id" => $tor->id]);

                        $this->db->update('torrent_announces', [
                            'seeders' => $seeders,
                            'leechers' => $leechers,
                            'times_completed' => $downloaded,
                            'online' => 'yes'
                        ], "`torrent_id` = :id", ["id" => $tor->id]);

                    } catch (ScraperException $exc) {
                        $exc->isConnectionError();
                    }
                } else {
                    $http = true;
                    try {
                        $timeout = 5;
                        $http = new HttpScraper($timeout);
                        $stats = $http->scrape($tracker, $tor->info_hash);

                        foreach ($stats as $idu => $scrape) {
                            $seeders += intval(strip_tags($scrape['seeders']));
                            $leechers += intval(strip_tags($scrape['leechers']));
                            $downloaded += intval(strip_tags($scrape['completed']));
                        }

                        $this->db->update('torrents', [
                            'times_completed' => $downloaded,
                            'leechers' => $leechers,
                            'seeders' => $seeders,
                            'visible' => 'yes',
                            'updated_at' => Helper::dateTime()
                        ], "`id` = :id", ["id" => $tor->id]);

                        $this->db->update('torrent_announces', [
                            'seeders' => $seeders,
                            'leechers' => $leechers,
                            'times_completed' => $downloaded,
                            'online' => 'yes'
                        ], "`torrent_id` = :id", ["id" => $tor->id]);

                    } catch (ScraperException $exc) {
                        $exc->isConnectionError();
                    }
                }
            }
        }

    }
    
}
