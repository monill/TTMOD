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

            $uploadlocal = TUPLOAD . basename($fname);

            if (!Helper::validFilename($fname)) {
                $errors[] = "Invalid filename.";
            }

            if (!preg_match('/^(.+)\.torrent$/si', $fname)) {
                $error[] = "Nome de arquivo inválido (não é .torrents).";
            }

            $name = Input::get('tname');
            $categ = Input::get('category');
            $uploader = Input::get('showuploader');
            $descr = Input::get('descr');

            if (!$errors)
            {
                if (!move_uploaded_file($ftmp_name, $uploadlocal)) {
                    $errors[] = "File Could not be copied.";
                }

                //$torrentInfo = array();
                $torrentInfo = new Parse("$uploadlocal/$fname");

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
                print ("<br /><br />announce: ".$announce);
                print ("<br /><br />infohash: ".$infohash);
                print ("<br /><br />creationdate: ".$creationdate);
                print ("<br /><br />internalname: ".$internalname);
                print ("<br /><br />torrentsize: ".$torrentsize);
                print ("<br /><br />filecount: ".$filecount);
                print ("<br /><br />annlist: ".$annlist);
                print ("<br /><br />comment: ".$comment);

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
