<?php

namespace App\Models;

use App\Libs\Database;

class User extends Model
{
    public $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = Database::getInstance();
    }

    private function __clone() { }

    public function classes($class)
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

    public static function invite($userid)
    {
        $db = Database::getInstance();

        $user = $db->select1("SELECT `invites` FROM `users` WHERE `id` = :id", ["id" => $userid]);

        $invites = $user->invites;

        $inv = $invites > 0 ? "s" : "";

        echo '<p class="text-center">' . "Voce tem " . $invites . " convite" . $inv . '</p>';

        if ($invites > 0) {
            echo '<p class="text-center"><a href="'. url('/invite') . '"> Enviar um convite </a></p>';
        }
    }

}
