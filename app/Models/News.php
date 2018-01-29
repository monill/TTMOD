<?php

namespace App\Models;

use App\Libs\Database;

class News extends Model
{
    public $db;

    public function __construct()
    {
        parent::__construct();
    }

    private function __clone() { }

    public static function all()
    {
        $db = Database::getInstance();
        return $db->select("SELECT * FROM `news` WHERE `created_at` >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) ORDER BY `created_at` DESC");
    }
}
