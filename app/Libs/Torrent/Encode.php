<?php

namespace App\Libs\Torrent;

class Encode
{
    public function __construct() { }

    public function __clone() { }

    // Dictionary keys must be sorted. foreach tends to iterate over the order
    // the array was made, so we make a new one in sorted order. :)
    public function makeSorted($array)
    {
        $i = 0;

        // Shouldn't happen!
        if (empty($array)) {
            return $array;
        }
        $keys = array();
        $return = array();
        foreach ($array as $key => $value) {
            $keys[$i++] = stripslashes($key);
        }
        sort($keys);
        for ($i = 0; isset($keys[$i]); $i++) {
            $return[addslashes($keys[$i])] = $array[addslashes($keys[$i])];
        }
        return $return;
    }

    // Encodes strings, integers and empty dictionaries.
    // $unstrip is set to true when decoding dictionary keys
    public function encodeEntry($entry, &$fd, $unstrip = false)
    {
        if (is_bool($entry)) {
            return $fd .= "de";
        }
        if (is_int($entry) || is_float($entry)) {
            return $fd .= "i" . $entry . "e";
        }
        if ($unstrip) {
            $myentry = stripslashes($entry);
        } else {
            $myentry = $entry;
        }
        $lenght = strlen($myentry);
        return $fd .= $lenght . ":" . $myentry;
    }

    // Encodes lists
    public function encodeList($array, &$fd)
    {
        $fd .= "l";
        // The empty list is defined as array();
        if (empty($array)) {
            return $fd .= "e";
        }
        for ($i = 0; isset($array[$i]); $i++) {
            $this->encodeDecide($array[$i], $fd);
        }
        return $fd .= "e";
    }

    // Passes lists and dictionaries accordingly, and has
    // encodeEntry handle the strings and integers.
    public function encodeDecide($unknown, &$fd)
    {
        if (is_array($unknown)) {
            if (isset($unknown[0]) || empty($unknown)) {
                return $this->encodeList($unknown, $fd);
            } else {
                return $this->encodeDict($unknown, $fd);
            }
        }
        return $this->encodeEntry($unknown, $fd);
    }

    public function encodeDict($array, &$fd)
    {
        $fd .= "d";
        if (is_bool($array)) {
            return $fd .= "e";
        }
        // NEED TO SORT!
        $newarray = $this->makeSorted($array);
        foreach ($newarray as $left => $right) {
            $this->encodeEntry($left, $fd, true);
            $this->encodeDecide($right, $fd);
        }
        return $fd .= "e";
    }
}