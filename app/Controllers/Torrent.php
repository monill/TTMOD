<?php

namespace App\Controllers;

use App\Libs\Helper;
use App\Libs\Input;
use App\Libs\Redirect;
use App\Libs\Torrent\Parse;

class Torrent extends Controller
{
    public $annouce = ANNOUNCE;

    public function __construct()
    {
        parent::__construct();
        // if (!$this->loggedIn()) {
        //     Redirect::to('/login');
        // }
    }

    public function __clone() { }

    public function index()
    {
        $this->view->title = SNAME . " :: Torrrents";
        $this->view->load('torrents/index', false);
    }

    public function view($slug)
    {
        $this->view->title = SNAME . " :: tal";
        $this->view->slug = $slug;
        $this->view->load('torrents/torrent', false);
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

            if (!Helper::validFilename($fname)) {
                $errors[] = "Invalid filename.";
            }

            if (!preg_match('/^(.+)\.torrent$/si', $fname)) {
                $errors[] = "Nome de arquivo inválido (não é .torrents).";
            }

            $name = Input::get('tname');
            $categ = Input::get('category');
            $uploader = Input::get('showuploader');
            $descr = Input::get('descr');

            if (!$errors)
            {
                if (!move_uploaded_file($ftmp_name, $uploadlocal)) {
                    $errors[] = "File Could not uploaded.";
                }

                $torrentInfo = [];
                $torrentInfo = new Parse("$uploadlocal");

                $announce       = $torrentInfo[0];
                $infohash       = $torrentInfo[1];
                $creationdate   = $torrentInfo[2];
                $internalname   = $torrentInfo[3];
                $torrentsize    = $torrentInfo[4];
                $filecount      = $torrentInfo[5];
                $annlist        = $torrentInfo[6];
                $comment        = $torrentInfo[7];
                $filelist       = $torrentInfo[8];

                //for debug...
                print ("<br>announce: " . $announce);
                print ("<br>infohash: " . $infohash);
                print ("<br>creationdate: " . $creationdate);
                print ("<br>internalname: " . $internalname);
                print ("<br>torrentsize: " . $torrentsize);
                print ("<br>filecount: " . $filecount);
                print ("<br>annlist: " . $annlist);
                print ("<br>comment: " . $comment);

                //check announce url is local or external
                if (!in_array($announce, $this->annouce, 1)) {
                    $external = 'yes';
                } else {
                    $external = 'no';
                }

            }

            //caso nome em branco pega o nome do arquivo
            if (empty($name)) {
                $name = $internalname;
            }

            if ($errors) {
                unlink("$uploadlocal");
                unlink($ftmp_name);
                $errors[] = "File deleted.";
            }

        } else {
            Redirect::to('/torrents/upload');
        }
    }

    public function edit($id)
    {

    }

    public function delete($id)
    {

    }

}
