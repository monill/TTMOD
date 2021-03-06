<?php

namespace App\Libs\Torrent;

use App\Libs\Torrent\Encode;
use App\Libs\Torrent\Decode;

class Bencode {

    public function __construct() { }

    private function __clone() { }

    public static function encode($data)
    {
        return Encode::encode($data);
    }

    public static function decode($wholefile) {
        $decode = new Decode();
        $re = $decode->decodeEntry($wholefile);
        return $re[0];
    }

}
