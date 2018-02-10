<?php

namespace App\Libs\Torrent;

use App\Libs\Database;
use App\Libs\Helper;

class MegaScrape
{
    private $db;
    private $parse;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->parse = new Parse();
    }

    public function __clone()
    {

    }

    public function tor()
    {
        set_time_limit(5);
        $interval = date('Y-m-d H:i:s', strtotime(date("Y-m-d H:i:s")) - 7200 * 24); // Rescrape torrents every x seconds. (Default: 2 days)

        $tor = $this->db->select("SELECT `id`, `info_hash`, `update_at` FROM `torrents` WHERE `external` = 'yes' AND `update_at` <= :olddate ORDER BY torrents.id DESC LIMIT 10", ["olddate" => $interval]);

        var_dump($tor);

        $updir = TUPLOAD;
        while ($tor) {

            $torInfo = $this->parse->torr("$updir.$tor->id");

            $announce = $torInfo[0];
            $infohash = $torInfo[1];
            $creationdate = $torInfo[2];
            $internalname = $torInfo[3];
            $torrentsize = $torInfo[4];
            $filecount = $torInfo[5];
            $annlist = $torInfo[6];
            $comment = $torInfo[7];
            $filelist = $torInfo[8];


            $seeders = $leechers = $downloaded = null;

            $annlist = array();

            if ($torInfo[6]) {
                foreach ($torInfo[6] as $ann) {
                    $annlist[] = $ann[0];
                }
            } else {
                $annlist = array($announce);
            }
        }
    }
}