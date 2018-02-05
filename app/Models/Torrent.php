<?php

namespace App\Models;

use App\Libs\Database;

class Torrent extends Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function __clone()
    {

    }

    public static function categories()
    {
        $db = Database::getInstance();
        return $db->select("SELECT * FROM `torrent_categories` ORDER BY `name` ASC");
    }

}
