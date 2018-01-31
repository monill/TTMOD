<?php

namespace App\Libs\Torrent;

use App\Libs\Torrent\Encode;
use App\Libs\Torrent\Decode;

class Bencode
{
    public function __construct() { }

    public function __clone() { }

    public static function encode($array)
    {
        $string = "";
        $encode = new Encode();
        return $encode->encodeDecide($array, $string);
    }

    public static function decode($wholefile)
    {
        $decode = new Decode();
        $re = $decode->decodeEntry($wholefile);
        return $re[0];
    }
}