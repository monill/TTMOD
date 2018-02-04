<?php

namespace App\Libs\Torrent;

class Parse {

    public function __construct() {

    }

    public function __clone() {

    }

    public function torr($filename = "")
    {
        $torrentInfo = array();

        $array = array();

        //check file type is a torrents
        $torrent = explode(".", $filename);
        $fileend = end($torrent);
        $fileend = strtolower($fileend);

        if ($fileend == "torrent") {
            $parse = file_get_contents("$filename", FILE_BINARY);

            if ($parse == false) {
                echo "Parser Error: Error Opening torrents, unable to get contents.<br>";
            }

            if (!isset($parse)) {
                echo "Parser Error: Error Opening torrent. Torrent file not chosen or could not be found.<br>";
            } else {
                $array = Bencode::decode($parse);

                if ($array === false) {
                    echo "Parser Error: Error Opening torrent, unable to decode.<br>";
                } else {
                    if (array_key_exists("info", $array) === false) {
                        echo "Parser Error: Error opening torrents.<br>";
                    } else {
                        //Get Announce URL
                        $torrentInfo[0] = $array["announce"];

                        //Get Announce List Array
                        if (isset($array["announce-list"])) {
                            $torrentInfo[6] = $array["announce-list"];
                        }

                        //Read info, store as (infovariable)
                        $info = $array["info"];

                        //Calculates SHA1 Hash
                        $torrentInfo[1] = sha1(Bencode::encode($info));

                        // Calculates date from UNIX Epoch
                        $torrentInfo[2] = date('r', $array["creation date"]);

                        // The name of the torrents is different to the file name
                        $torrentInfo[3] = $info['name'];

                        //Get file list
                        if (isset($info["files"]) && is_array($info["files"])) {
                            //Multi file torrents
                            $filecount = 0;

                            //Get filenames here
                            $torrentInfo[8] = $info["files"];

                            foreach ($info["files"] as $file) {
                                $torrentInfo[5] = $filecount++; //Get file count
                                $torrentInfo[4] += $file['length'];
                            }

                        } else {
                            // Single File Torrent
                            $torrentInfo[3] = $info['name'];
                            $torrentInfo[4] = $info['length'];
                            $torrentInfo[5] = 1;
                        }

                        //Get torrents comment
                        if (isset($array['comment'])) {
                            $torrentInfo[7] = $array['comment'];
                        }
                    }
                }
            }
        }
        return $torrentInfo;
        //print_r($torrentInfo);
    }

}
