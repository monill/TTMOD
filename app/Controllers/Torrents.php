<?php

namespace App\Controllers;

use App\Libs\Redirect;

class Torrents extends Controller
{
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
        $this->view->title = SNAME . " :: Torrents";
        $this->view->load('torrents/index', false);
        exit();
    }

    public function upload()
    {
        $this->view->title = SNAME . " :: Torrent Upload";
        $this->view->categorias = Torrent::categorias();
        $this->view->load('torrents/upload', false);
        exit();
    }

    public function torrentupload($data)
    {

    }

    public function torrent($id)
    {
        echo $id;
    }
}
