<?php

namespace App\Libs\Torrent;

class Parse {

    public function __construct($filename = '') {
        $torrentInfo = array();

        //global $array;

        //check file type is a torrents
        $torrent = explode(".", $filename);
        $fileend = end($torrent);
        $fileend = strtolower($fileend);

        if ($fileend == "torrent") {
            $parse = file_get_contents("$filename");

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
                        $infovariable = $array["info"];

                        //Calculates SHA1 Hash
                        $infohash = sha1(Bencode::encode($infovariable));
                        $torrentInfo[1] = $infohash;

                        // Calculates date from UNIX Epoch
                        $torrentInfo[2] = date('r', $array["creation date"]);

                        // The name of the torrents is different to the file name
                        $torrentInfo[3] = $infovariable['name'];

                        //Get file list
                        if (isset($infovariable["files"]) && is_array($infovariable["files"])) {
                            //Multi file torrents
                            $filecount = 0;
                            $torrentsize = 0;

                            //Get filenames here
                            $torrentInfo[8] = $infovariable["files"];

                            foreach ($infovariable["files"] as $file) {
                                //var_dump($file);
                                $filecount = ++$filecount;
                                $multiname = $file['path']; //Not needed here really
                                $multitorrentsize = $file['length'];
                                $torrentsize += $file['length'];
                            }

                            $torrentInfo[4] = $torrentsize; //Add all parts sizes to get total
                            $torrentInfo[5] = $filecount; //Get file count
                        } else {
                            // Single File Torrent
                            $torrentsize = $infovariable['length'];
                            $torrentInfo[4] = $torrentsize; //Get file count
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
        //return $torrentInfo;
        var_dump($torrentInfo);
    }

    public function __clone() {

    }

}
