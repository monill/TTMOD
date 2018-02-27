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
    private function __construct($data)
    {
        $this->content = $data;
    }

    private function __clone() { }

    static public function encode($data)
    {
        if (is_object($data)) {
            if (method_exists($data, 'toArray')) {
                $data = $data->toArray();
            } else {
                $data = (array) $data;
            }
        }
        $encoder = new self($data);
        return $encoder->encodeDecide($data);
    }

    /**
    * Passes lists and dictionaries accordingly,
    * and has encodeString handle the strings and integers.
    *
    * @param  mixed $data
    * @return string|void
    */
    private function encodeDecide($data)
    {
        $data = is_null($data) ? $this->content : $data;

        if (is_array($data) && (isset($data[0]) || empty($data))) {
            return $this->encodeList($data);
        } elseif (is_array($data)) {
            return $this->encodeDict($data);
        } elseif (is_integer($data) || is_float($data)) {
            $data = sprintf('%.0f', round($data, 0));
            return $this->encodeInt($data);
        } else {
            return $this->encodeString($data);
        }
    }

    /**
     * Encodes strings, integers and empty dictionaries.
     *
     * @param  mixed   $entry
     * @param  boolean $unstrip is set to true when decoding dictionary keys
     * @return void
     */
    private function encodeString($entry, $unstrip = false)
    {
        if (is_bool($entry)) {
            $this->content .= "de";
        }
        if (is_int($entry) || is_float($entry)) {
            $this->content .= "i" . $entry . "e";
        }
        if ($unstrip) {
            $myentry = stripslashes($entry);
        } else {
            $myentry = $entry;
        }
        $lenght = strlen($myentry);
        $this->content .= $lenght . ":" . $myentry;
    }

    /**
     * Encode an integer into a bencode integer
     *
     * @param integer $data The integer to be encoded.
     * @return string Returns the bencoded integer.
     */
    private function encodeInt($data = null)
    {
        $data = is_null($data) ? $this->content : $data;
        return sprintf('i%.0fe', $data);
    }

    /**
     * Encodes lists
     *
     * @param  array $array
     * @return void
     */
    private function encodeList(array $data = null)
    {
        $data = is_null($data) ? $this->content : $data;

        $list = '';
        foreach ($data as $value) {
            $list .= $this->encodeDecide($value);
        }
        return "l{$list}e";
    }

    /**
     * Encodes dictionaries
     *
     * @param  mixed $array
     * @return void
     */
    private function encodeDict(array $data = null)
    {
        $data = is_null($data) ? $this->content : $data;
        sort($data);

        $dict = '';
        foreach ($data as $left => $right) {
            $dict .= $this->encodeString($left) . $this->encodeDecide($right);
        }
        return "d{$dict}e";
    }

}
