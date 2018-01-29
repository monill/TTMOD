<?php

namespace App\Controllers;

use App\Libs\Redirect;
use App\Libs\Input;

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

    public function search()
    {
        if (Input::exist()) {
            $search = Input::get('search');


        } else {
            Redirect::to('/torrents');
        }
    }

    public function advsearch()
    {
        if (Input::exist()) {



        } else {
            Redirect::to('/torrents');
        }
    }

    public function categ($slug = '')
    {
        
    }
}
