<?php

namespace App\Models;

use App\Libs\Database;

class Rules extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function __clone() {
        
    }

    public static function all() {
        $db = Database::getInstance();
        return $db->select("SELECT * FROM `rules`");
    }

}
