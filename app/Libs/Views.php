<?php

namespace App\Libs;

class Views
{
    public function __construct() { }

    public function __clone() { }

    public function load($file, $inc = false)
    {
        if (!$inc) {
            require_once ROOT . 'views/header.php';
            require_once ROOT . 'views/' . $file . '.php';
            require_once ROOT . 'views/footer.php';
        } else {
            require_once ROOT . 'views/' . $file . '.php';
        }
    }
}
