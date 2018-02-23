<?php

namespace App\Controllers;

class Scrape extends Controller
{
    //TODO
    //doing or delete?

    public function __construct()
    {
        parent::__construct();
    }

    private function __clone() { }

    public function index()
    {
        // check if client can handle gzip
        if (stristr($_SERVER["HTTP_ACCEPT_ENCODING"], "gzip") && extension_loaded('zlib') && ini_get("zlib.output_compression") == 0) {
            if (ini_get('output_handler') != 'ob_gzhandler') {
                ob_start("ob_gzhandler");
            } else {
                ob_start();
            }
        } else {
            ob_start();
        }
        // end gzip controll

        $infohash = array();

        foreach (explode("&", $_SERVER["QUERY_STRING"]) as $item) {
            if (preg_match("#^infohash=(.+)\$#", $item, $m)) {
                $hash = urldecode($m[1]);

                var_dump($hash);

                if (get_magic_quotes_gpc()) {
                    $info_hash = stripslashes($hash);
                } else {
                    $info_hash = $hash;
                }
                if (strlen($info_hash) == 20) {
                    $info_hash = bin2hex($info_hash);
                } else if (strlen($info_hash) != 40) {
                    continue;
                }
                $infohash[] = strtolower($info_hash);
            }
        }

//        if (!count($infohash)) {
//            die("Invalid infohash.");
//        }

        //$query = $this->db->select1("SELECT infohash, seeders, leechers, times_completed, filename FROM torrents WHERE infohash = :infoh ", ["infoh" => $infohash]);

        print_r($infohash);

        //$result = "d5:filesd";

//        while ($row = $query) {
//            $hash = pack("H*", $row[0]);
//            $result .= "20:" . $hash . "d";
//            $result .= "8:completei" . $row[1] . "e";
//            $result .= "10:downloadedi" . $row[3] . "e";
//            $result .= "10:incompletei" . $row[2] . "e";
//            $result .= "4:name" . strlen($row[4]) . ":" . $row[4] . "e";
//            $result .= "e";
//        }
//
//        $result .= "ee";

       // echo $result;

        ob_end_flush();
    }

}
