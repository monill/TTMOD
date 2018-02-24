<?php

namespace App\Controllers;

use App\Libs\Torrent\Bencode;

class Scrape extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    private function __clone() { }

    public function index()
    {
        //check if client can handle gzip
        if (stristr($_SERVER["HTTP_ACCEPT_ENCODING"], "gzip") && extension_loaded('zlib') && ini_get("zlib.output_compression") == 0) {
            if (ini_get('output_handler') != 'ob_gzhandler') {
                ob_start("ob_gzhandler");
            } else {
                ob_start();
            }
        } else {
            ob_start();
        }

        $infohash = array();

        foreach (explode("&", $_SERVER["QUERY_STRING"]) as $item) {
            if (preg_match("#^info_hash=(.+)\$#", $item, $m)) {
                $hash = urldecode($m[1]);

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

        if (!count($infohash)) die("Invalid infohash");

        $torrent = $this->db->select1("SELECT info_hash, seeders, leechers, times_completed, filename FROM torrents WHERE info_hash = :infoh ", ["infoh" => $info_hash]);

//        $res = "d5:files";
//        foreach ($torrent as $key => $val) {
//            $hash = hex2bin($val->info_hash);
//            $res .= "d20:" . $hash;
//            $res .= "d8:completei" . (int)$val->seeders;
//            $res .= "e10:downloadedi" . $val->times_completed;
//            $res .= "e10:incompletei" . (int)$val->leechers;
//            $res .= "e4:name" . strlen($val->filename) . ":" . $val->filename;
//            $res .= "ee";
//        }
//        $res .= "ee";

        $res = [];
        $res['infohash'] = $torrent->info_hash;
        $res['complete'] = (int)$torrent->seeders;
        $res['downloaded'] = (int)$torrent->times_completed;
        $res['incomplete'] = (int)$torrent->leechers;
        $res['interval'] = (60 * 45);
        $res['min interval'] = (60 * 30);

        //$data = Bencode::encode($res);
        $data = \Rych\Bencode\Bencode::encode($res);

        header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
        header("Content-Type: text/plain; charset=UTF-8");
        header("Pragma: no-cache");
        print $data;
        ob_end_flush();
        exit();
    }

}
