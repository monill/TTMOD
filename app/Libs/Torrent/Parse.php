<?php

namespace App\Libs\Torrent;

class Parse
{
    public function __construct() { }

    public function __clone() { }

    public static function torrent($filename)
    {
        $torrentInfo = array();
        //check file type is a torrent
        $torrent = explode(".", $filename);
        $fileend = end($torrent);
        $fileend = strtolower($fileend);

        if ($fileend == "torrent") {
            $parseme = file_get_contents("$filename");
            if ($parseme == FALSE) {
                echo "Parser Error: Error Opening torrent, unable to get contents.";
            }
            if (!isset($parseme)) {
                echo "Parser Error: Error Opening torrent.";
            } else {
                $array = Bencode::decode($parseme);
                if ($array === FALSE) {
                    echo "Parser Error: Error Opening torrent, unable to decode.";
                }else {
                    if (!count($array['info'])) {
                        echo "Parser Error: Error Opening torrent.";
                    } else {
                        //Get Announce URL
                        $torrentInfo[0] = $array["announce"];
                        //Get Announce List Array
                        if (isset($array["announce-list"])) {
                            $torrentInfo[6] = $array["announce-list"];
                        }
                        //Read info, store as (infovariable)
                        $infovariable = $array["info"];
                        // Calculates SHA1 Hash
                        $infohash = sha1(Bencode::encode($infovariable));
                        $torrentInfo[1] = $infohash;
                        // Calculates date from UNIX Epoch
                        $makedate = date('r', $array["creation date"]);
                        $torrentInfo[2] = $makedate;
                        // The name of the torrent is different to the file name
                        $torrentInfo[3] = $infovariable["name"];
                        //Get File List
                        if (isset($infovariable["files"])) {
                            // Multi File Torrent
                            $filecount = "";
                            $torrentsize = "";
                            //Get filenames here
                            $torrentInfo[8] = $infovariable["files"];
                            foreach ($infovariable["files"] as $file) {
                                $filecount += "1";
                                $multiname = $file["path"]; //Not needed here really
                                $multitorrentsize = $file["length"];
                                $torrentsize += $file["length"];
                            }
                            $torrentInfo[4] = $torrentsize;  //Add all parts sizes to get total
                            $torrentInfo[5] = $filecount;  //Get file count
                        } else {
                            // Single File Torrent
                            $torrentsize = $infovariable["lenght"];
                            $torrentInfo[4] = $torrentsize; //Get file count
                            $torrentInfo[5] = "1";
                        }
                        // Get Torrent Comment
                        if (isset($array["comment"])) {
                            $torrentInfo[7] = $array["comment"];
                        }
                    }
                }
            }
        }
        return $torrentInfo;
    }
}