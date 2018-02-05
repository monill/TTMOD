<?php

namespace App\Controllers;

use App\Libs\Helper;
use App\Libs\Input;
use App\Libs\Redirect;
use App\Libs\Torrent\Bencode;
use App\Libs\Torrent\Parse;
use App\Libs\Torrent\ScrapeUrl;

class Torrent extends Controller {

    public function __construct()
    {
        parent::__construct();
        // if (!$this->loggedIn()) {
        //     Redirect::to("/login");
        // }
    }

    public function __clone()
    {

    }

    public function index()
    {
        Redirect::to("/torrents");
    }

    public function view($id)
    {
        $this->view->title = SNAME . " :: tal";
        $this->view->torrents = $id;
        $this->view->load("torrents/torrent", false);
    }

    public function upload()
    {
        if (Input::exist())
        {
            $errors = array();

            $torrent = $_FILES['torrent'];

            $fname = $torrent['name'];
            $ftype = $torrent['type'];
            $ftmp_name = $torrent['tmp_name'];
            $ferror = $torrent['error'];
            $fsize = $torrent['size'];

            $uploadlocal = TUPLOAD . $fname;
            $uploaddir = TUPLOAD;

            if (!Helper::validFilename($fname)) {
                $errors[] = "Invalid filename.";
            }

            if (!preg_match("/^(.+)\.torrent$/si", $fname)) {
                $errors[] = "Invalid filename not (.torrent).";
            }

            $name = Input::get("tname");
            $categ = Input::get("category");
            $uploader = Input::get("showuploader");
            $descr = Input::get("descr");

            if (!$errors) {
                if (!move_uploaded_file($ftmp_name, $uploadlocal)) {
                    $errors[] = "File Could not uploaded.";
                }

                $torInfo = new Parse();
                $tor = $torInfo->torr("$uploadlocal");

               $announce = $tor[0];
               $infohash = $tor[1];
               $creationdate = $tor[2];
               $internalname = $tor[3];
               $torrentsize = $tor[4];
               $filecount = $tor[5];
               $annlist = $tor[6];
               $comment = $tor[7];
               $filelist = $tor[8];

                //for debug...
               // print ("<br>announce: " . $announce);
               // print ("<br>infohash: " . $infohash);
               // print ("<br>creationdate: " . $creationdate);
               // print ("<br>internalname: " . $internalname);
               // print ("<br>torrentsize: " . $torrentsize);
               // print ("<br>filecount: " . $filecount);
               // print ("<br>annlist: " . $annlist);
               // print ("<br>comment: " . $comment);

                //check announce url is local or external
               if ($announce !== ANNOUNCE) {
                    $external = "yes";
               } else {
                    $external = "no";
               }
            }

            //case blank name takes the file name
            if (empty($name)) {
                $name = $internalname;
            }

            if ($errors) {
                unlink("$uploadlocal");
                unlink($ftmp_name);
                $errors[] = "File deleted.";
            }

            $change = [
                "_", " - ", ".rar", " ", ".avi", ".mpeg", ".exe", ".zip", ".wmv",
                ".iso", ".bin", ".txt", ".nfo", ".7z", ".mp3", ".mp4",".mkv", ".torrent"
            ];

            $name = str_replace($change, "", $name);

            //TODO
            //fix this
            $this->db->insert('torrents', [
                'infohash' => $infohash,
                'name' => Helper::escape($name),
                'filename' => Helper::escape($internalname),
                'description' => Helper::escape($descr),
                'poster' => '',
                'image1' => '',
                'image2' => '',
                'image3' => '',
                'category_id' => $categ,
                'size' => $torrentsize,
                'numfiles' => $filecount,
                'anon' => $uploader,
                'nfo' => '',
                'announce' => $announce,
                'external' => $external,
                'uploader_id' => 1,
                'created_at' => Helper::dateTime()
            ]);

            $idd = $this->db->lastInsertId("id");

            if ($idd == 0) {
                unlink("$uploadlocal");
                unlink($ftmp_name);
                $errors[] = "No ID. Server error, please report.";
            } else {
                //TODO
                //fix this name nothing change
                rename("$uploaddir/$fname", "$uploaddir/$idd.torrent");
            }

            if (count($filelist)) {
                foreach ($filelist as $file) {
                    $dir = "";
                    $size = $file['length'];
                    $count = count($file['path']);

                    for ($i = 0; $i < $count; $i++) {
                        if (($i + 1) == $count) {
                            $fname = $dir.$file['path'][$i];
                        } else {
                            $dir .= $file['path'][$i] . "/";
                        }
                    }

                    $this->db->insert('torrent_files', [
                        'path' => Helper::escape($fname),
                        'length' => (int) $size,
                        'torrent_id' => (int) $idd,
                        'created_at' => Helper::dateTime(),
                        'update_at' => Helper::dateTime()
                    ]);
                }
            } else {
                $this->db->insert('torrent_files', [
                    'path' => Helper::escape($tor[3]),
                    'length' => (int) $torrentsize,
                    'torrent_id' => (int) $idd,
                    'created_at' => Helper::dateTime(),
                    'update_at' => Helper::dateTime()
                ]);
            }

            if (!count($annlist)) {
                $annlist = [[$announce]];
            }

            foreach ($annlist as $ann) {
                foreach ($ann as $value) {
                    if (strtolower(substr($value, 0, 4)) != "udp:") {
                        $this->db->insert('torrent_announces', [
                            'url' => Helper::escape($value),
                            'torrent_id' => (int) $idd
                        ]);
                    }
                }
            }

            //External scrape
            if ($external == "yes") {
                $tracker    = str_replace(["udp://", "/announce", ":80/"], ["http://", "/scrape", "/"], $announce);
                //$tracker    = str_replace("/announce", "/scrape", $announce);
                $stat = new ScrapeUrl();
                $stats = $stat->torrent($tracker, $infohash);
                $seeders    = intval(strip_tags($stats['seeds']));
                $leechers 	= intval(strip_tags($stats['peers']));
                $downloaded = intval(strip_tags($stats['downloaded']));

                $this->db->update('torrents', [
                    'leechers' => $leechers,
                    'seeders' => $seeders,
                    'timescompleted' => $downloaded,
                    'update_at' => Helper::dateTime(),
                    'visible' => 'yes'
                ], "`id` = :id", ["id" => $idd]);
            }
            //End Scrape

            if ($external == "yes") {
                $message = printf("Torrent Upado OK:<br><br />%s foi carregado.<br><br> Lembre-se de voltar a baixar para que sua passkey seja adicionada e você pode semear este torrents.<br><br><a href='" . url('/torrent/download/') . "%d'>Baixar Agora</a><br><a href='" . url('/torrent/view/') . "%d'>Ver Torrent Upado </a><br><br>", $name, $idd, $idd);
            } else {
                $message = printf("Torrent Upado OK:<br><br>%s foi carregado.<br><br><a href='" . url('/torrent/view/') . "%d'>Ver Torrent Upado</a><br><br>", $name, $idd);
                echo "Upload Completed.";
            }

            echo $message;

//            if ($errors) {
//                $result = ["status" => "error", "errors" => $errors];
//                echo json_encode($result);
//            }

            die();

        } else {
            Redirect::to("/torrents/upload");
        }
    }

    public function edit($id)
    {

    }

    public function delete($id)
    {

    }

    public function download($id)
    {
        if (isset($id))
        {
            //TODO
            //fix this passkey on users
            $user = $this->db->select1("SELECT `passkey` FROM `users` WHERE `id` = :idd AND `status` = 'confirmed' LIMIT 1", ["idd" => 1]);

            $torrent = $this->db->select1("SELECT * FROM `torrents` WHERE `id` = :id LIMIT 1", ["id" => $id]);

            $errors = array();

            if (count($torrent) === 1)
            {
                $file = TUPLOAD . "$id.torrent";

                if ($torrent->banned == "yes") {
                    $errors[] = "Torrent banned. <br>";
                }

                if (!is_file($file)) {
                    $errors[] = "File not found <br>";
                    $errors[] = "The ID has been found on the Database, but the torrents has gone! <br> Check Server Paths and CHMODs Are Correct! <br>";
                }

                if (!is_readable($file)) {
                    $errors[] = "File not found <br>";
                    $errors[] = "The ID and torrents were found, but the torrents is NOT readable! <br>";
                }

                if (count($errors) == 0)
                {
                    $name = $torrent->name . "[" . SNAME . "]";

                    $downs = (int)$torrent->downs;
                    $this->db->update('torrents', ['downs' => $downs + 1], "id = :id", ["id" => $id]);

                    if ($torrent->external != "yes")
                    {
                        $arq = file_get_contents("$file");
                        $decoded = Bencode::decode($arq);
                        echo $decoded["announce"] = ANNOUNCE . $user->passkey;
                        unset($decoded["announce-list"]);

                        $data = Bencode::encode($decoded);

                        header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
                        header("Cache-Control: public"); // needed for internet explorer
                        header("Content-Type: application/x-bittorrent");
                        //header("Content-Length:" . filesize($data)); //error if uncomment this
                        header("Content-Disposition: attachment; filename=" . $name . ".torrent");
                        ob_clean();
                        flush();
                        print $data;
                        exit();

                    } else {

                        header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
                        header("Cache-Control: public"); // needed for internet explorer
                        header("Content-Type: application/x-bittorrent");
                        header("Content-Length:" . filesize($file));
                        header("Content-Disposition: attachment; filename=" . $name . ".torrent");
                        ob_clean();
                        flush();
                        readfile($file);
                        exit();
                    }

                } else {
                    $result = ["status" => "error", "errors" => $errors];
                    echo json_encode($result);
                }
            }
        } else {
            Redirect::to("/torrents");
        }

    }

}
