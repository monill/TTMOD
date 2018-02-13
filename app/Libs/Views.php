<?php

namespace App\Libs;

class Views {

    private function __construct() { }

    private function __clone() { }

    public function load($file, $inc = false)
    {
        if (!$inc) {
            require_once ROOT . "views/header.php";
            require_once ROOT . "views/" . $file . ".php";
            require_once ROOT . "views/footer.php";
            exit();
        } else {
            require_once ROOT . "views/" . $file . ".php";
            exit();
        }
    }

}
