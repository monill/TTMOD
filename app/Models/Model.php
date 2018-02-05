<?php

namespace App\Models;

use App\Libs\Database;

class Model {

    public $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function __clone()
    {

    }

}
