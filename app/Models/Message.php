<?php

namespace App\Models;

use App\Libs\Database;

class Message extends Model {

    public function __construct() {
        parent::__construct();
    }

    private function __clone() {

    }

    public static function inbox($userid)
    {
        $db = Database::getInstance();
        return $db->select("SELECT * FROM `messages` WHERE `receiver` = :uid AND `whereis` = 'inbox' ORDER BY id ASC", ["uid" => $userid]);
    }

    public static function outbox($userid)
    {
        $db = Database::getInstance();
        return $db->select("SELECT * FROM `messages` WHERE `sender` = :uid AND `whereis` = 'outbox'", ["uid" => $userid]);
    }

}
