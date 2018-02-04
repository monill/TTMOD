<?php

namespace App\Models;

use App\Libs\Database;

class Faq extends Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function __clone()
    {

    }

    public static function categ()
    {
        $db = Database::getInstance();
        return $db->select("SELECT * FROM `faq_categs`");
    }

    public static function answer()
    {
        $db = Database::getInstance();
        return $db->select("SELECT * FROM `faqs`");
    }

}
