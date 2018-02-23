<?php

namespace App\Models;

use App\Libs\Database;

class Torrent extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    private function __clone() { }

    public static function categories()
    {
        $db = Database::getInstance();
        return $db->select("SELECT * FROM `torrent_categories` ORDER BY `name` ASC");
    }

    public static function all()
    {
        $db = Database::getInstance();
        return $db->select("SELECT torrents.id, torrents.anon, torrents.category_id, torrents.leechers, torrents.seeders,
            torrents.name, torrents.size, torrents.created_at, torrents.comments, torrents.uploader_id, torrents.freeleech, torrent_categories.name AS cat_name,
            torrent_categories.slug AS cat_slug, users.username FROM torrents LEFT JOIN torrent_categories ON category_id = torrent_categories.id LEFT JOIN users ON torrents.uploader_id = users.id");;
    }

}
