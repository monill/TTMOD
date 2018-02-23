<?php

namespace App\Libs;

class Redirect
{
    public $url;

    public function __construct() { }

    private function __clone() { }

    public static function to($url)
    {
        if (!headers_sent()) {
            header("Location: " . $url, true, 302);
            exit();
        } else {
            echo '<script type="text/javascript">';
            echo 'window.location.href="' . $url . '";';
            echo '</script>';
            echo '<noscript>';
            echo '<meta http-equiv="refresh" content="0; url=' . $url . '" />';
            echo '</noscript>';
            exit();
        }
    }

}
