<?php

namespace App\Models;

use App\Libs\Database;

class Layout extends Model {

    public function __construct() {
        parent::__construct();
    }

    private function __clone() {
        
    }

    public static function left() {
        $db = Database::getInstance();

        $test = $db->select("SELECT * FROM `layouts` WHERE `position` = 'left' AND `enabled` = 1 ORDER BY `sort`");

        foreach ($test as $key => $value) {
            include VIEWS . 'layouts/' . $value->name . '_layout.php';
        }
    }

    public static function right() {
        $db = Database::getInstance();

        $test = $db->select("SELECT * FROM `layouts` WHERE `position` = 'right' AND `enabled` = 1 ORDER BY `sort`");

        foreach ($test as $key => $value) {
            include VIEWS . 'layouts/' . $value->name . '_layout.php';
        }
    }

    public static function middle() {
        $db = Database::getInstance();

        $test = $db->select("SELECT * FROM `layouts` WHERE `position` = 'middle' AND `enabled` = 1 ORDER BY `sort`");

        foreach ($test as $key => $value) {
            include VIEWS . 'layouts/' . $value->name . '_layout.php';
        }
    }

}
