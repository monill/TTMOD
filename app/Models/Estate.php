<?php

namespace App\Models;

use App\Libs\Database;

class Estate extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    private function __clone() { }

    public static function all()
    {
        $db = Database::getInstance();
        return $db->select("SELECT * FROM `estates` ORDER BY `name` ASC");
    }
}
