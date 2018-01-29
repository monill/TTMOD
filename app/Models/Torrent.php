<?php

namespace App\Models;

use App\Libs\Database;

class Torrent extends Model
{
    public $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = Database::getInstance();
    }

    private function __clone() { }

    public static function categories()
    {
        $db = Database::getInstance();
        return $db->select("SELECT * FROM `categories` ORDER BY `name` ASC");
    }


}
