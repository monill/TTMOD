<?php

namespace App\Libs\Torrent;

class Encode {

    /**
    * @var string
    */
    protected $content;

    /**
    *
    * @param array $info
    */
    public function __construct() { }

    private function __clone() { }

    /**
    * Passes lists and dictionaries accordingly,
    * and has encodeEntry handle the strings and integers.
    *
    * @param  mixed $unknown
    * @return string|void
    */
    public function encodeDecide($unknown)
    {
        if (is_array($unknown)) {
            if (isset($unknown[0]) || empty($unknown)) {
                return $this->encodeList($unknown);
            } else {
                return $this->encodeDict($unknown);
            }
        }
        return $this->encodeEntry($unknown);
    }

    /**
     * Encodes strings, integers and empty dictionaries.
     *
     * @param  mixed   $entry
     * @param  boolean $unstrip is set to true when decoding dictionary keys
     * @return void
     */
    public function encodeEntry($entry, $unstrip = false)
    {
        if (is_bool($entry)) {
            return $this->content .= "de";
        }
        if (is_int($entry) || is_float($entry)) {
            return $this->content .= "i" . $entry . "e";
        }
        if ($unstrip) {
            $myentry = stripslashes($entry);
        } else {
            $myentry = $entry;
        }
        $lenght = strlen($myentry);
        return $this->content .= $lenght . ":" . $myentry;
    }

    /**
     * Encodes lists
     *
     * @param  array $array
     * @return void
     */
    public function encodeList($array)
    {
        $this->content .= "l";

        // The empty list is defined as array();
        if (empty($array)) {
            return $this->content .= "e";
        }

        for ($i = 0; isset($array[$i]); $i++) {
            $this->encodeDecide($array[$i]);
        }
        return $this->content .= "e";
    }

    /**
     * Encodes dictionaries
     *
     * @param  mixed $array
     * @return void
     */
    public function encodeDict($array)
    {
        $this->content .= "d";

        if (is_bool($array)) {
            return $this->content .= "e";
        }

        // NEED TO SORT!
        $newarray = $this->makeSorted($array);

        foreach ($newarray as $left => $right) {
            $this->encodeEntry($left, true);
            $this->encodeDecide($right);
        }
        return $this->content .= "e";
    }

    /**
     * Dictionary keys must be sorted. foreach tends to iterate over the
     * order the array was made, so we make a new one in sorted order.
     *
     * @param  array $array
     * @return array
     */
    public function makeSorted($array)
    {
        $i = 0;

        // Shouldn't happen!
        if (empty($array)) {
            return $array;
        }

        foreach ($array as $key => $value) {
            $keys[$i++] = stripslashes($key);
        }

        sort($keys);

        for ($i = 0; isset($keys[$i]); $i++) {
            $return[addslashes($keys[$i])] = $array[addslashes($keys[$i])];
        }
        return $return;
    }

    /**
     * Get torrent
     *
     * @return string
     */
    public function __toString()
    {
        return $this->content;
    }

}
