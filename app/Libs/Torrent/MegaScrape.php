<?php

namespace App\Libs\Torrent;

use App\Libs\Database;
use App\Libs\Helper;

class MegaScrape
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
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
    }
}