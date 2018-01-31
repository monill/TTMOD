<?php

namespace App\Libs\Torrent;

class Parse
{
    public function __construct($filename)
    {
        $torrentInfo = [];

        //check file type is a torrents
        $torrent = explode('.', $filename);
        $fileend = end($torrent);
        $fileend = strtolower($fileend);

        if ($fileend == "torrent") {
            $parse = file_get_contents($filename);

            if ($parse == false) {
                echo "Parser Error: Error Opening torrents, unable to get contents.<br>";
            }

            if (!isset($parse)) {
                echo "Parser Error: Error Opening torrents.<br>";
            } else {
                $array = Bencode::decode($parse);

                if ($array === false) {
                    echo "Parser Error: Error Opening torrent, unable to decode.<br>";
                } else {
                    if (!count($array['info'])) {
                        echo "Parser Error: Error opening torrents.<br>";
                    } else {
                        //Get Announce URL
                        $torrentinfo[0] = $array['announce'];

                        //Get Announce List Array
                        if (isset($array['announce-list'])) {
                            $torrentinfo[6] = $array['announce-list'];
                        }

                        //Read info, store as (infovariable)
                        $infovariable = $array['info'];

                        //Calculates SHA1 Hash
                        $infohash = sha1(Bencode::encode($infovariable));
                        $torrentinfo[1] = $infohash;

                        // Calculates date from UNIX Epoch
                        $makedate = date('r', $array['creation date']);
                        $torrentinfo[2] = $makedate;

                        // The name of the torrents is different to the file name
                        $torrentinfo[3] = $infovariable['name'];

                        //Get file list
                        if (isset($infovariable['files'])) {
                            //Multi file torrents
                            $filecount = '';
                            //Get filenames here
                            $torrentinfo[8] = $infovariable['files'];

                            foreach ($infovariable["files"] as $file) {
                                $filecount += "1";
                                $multiname = $file['path']; //Not needed here really
                                $multitorrentsize = $file['length'];
                                $torrentsize += $file['length'];
                            }

                            $torrentinfo[4] = $torrentsize; //Add all parts sizes to get total
                            $torrentinfo[5] = $filecount; //Get file count
                        } else {
                            // Single File Torrent
                            $torrentsize = $infovariable['piece length'];
                            $torrentinfo[4] = $torrentsize; //Get file count
                            $torrentinfo[5] = "1";
                        }

                        //Get torrents comment
                        if (isset($array['comment'])) {
                            $torrentinfo[7] = $array['comment'];
                        }
                    }
                }
            }
        }
        return $torrentInfo;
    }

    public function __clone() { }
}