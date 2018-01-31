<?php

namespace App\Models;

use App\Libs\Database;

class User extends Model {

    public function __construct() {
        parent::__construct();
    }

    private function __clone() {
        
    }

    public function classes($class) {
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
