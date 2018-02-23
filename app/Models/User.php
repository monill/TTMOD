<?php

namespace App\Models;

use App\Libs\Database;

class User extends Model
{
    public function __construct()
    {
        //parent::__construct();
    }

    private function __clone() { }

    public static function members()
    {
        $db = Database::getInstance();
        return $db->select("SELECT `id`, `username`, `class`, `created_at`, `estate_id` FROM `users` WHERE status = 'confirmed' AND `privacy` != 'private' AND `class` != 'boss' ORDER BY `username` ASC");

        //"SELECT * FROM users LEFT JOIN estates ON estates.id = users.estate_id WHERE users.status = 'confirmed' AND users.privacy != 'private' ORDER BY `username` ASC";
        //$db->select("SELECT `id`, `username`, `class`, `created_at`, `estate_id` FROM `users` LEFT JOIN `estates` ON estates.id = users.estate_id WHERE `users.status` = 'confirmed' AND `users.privacy` != 'strong' ORDER BY `username` ASC");
    }

    public static function staffs()
    {
        $db = Database::getInstance();
        return $db->select("SELECT `id`, `username`, `class` FROM `users` WHERE `status` = 'confirmed' AND `class` IN ('moderator', 'moderatorplus', 'admin') ORDER BY `username` ASC");
    }

    public static function classes($class)
    {
        if ($class == "member") {
            return "Member";
        } elseif ($class == "memberplus") {
            return "Member Plus";
        } elseif ($class == "vip") {
            return "Vip";
        } elseif ($class == "uploader") {
            return "Uploader";
        } elseif ($class == "moderator") {
            return "Moderator";
        } elseif ($class == "moderatorplus") {
            return "Moderator Plus";
        } elseif ($class == "admin") {
            return "Admin";
        } elseif ($class == "boss") {
            return "Boss";
        } else {
            return "Undefined";
        }
    }


}
