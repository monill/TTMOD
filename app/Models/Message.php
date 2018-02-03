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
        return $db->select("SELECT * FROM `messages` WHERE `receiver` = :uid AND `wherein` = 'inbox' ORDER BY id DESC", ["uid" => $userid]);
    }

    public static function outbox($userid)
    {
        $db = Database::getInstance();
        return $db->select("SELECT * FROM `messages` WHERE `sender` = :uid AND `whereout` = 'inbox' ORDER BY id DESC", ["uid" => $userid]);
    }

}
