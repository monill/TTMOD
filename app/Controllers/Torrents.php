<?php

namespace App\Controllers;

use App\Libs\Redirect;
use App\Libs\Input;
use App\Libs\Token;
use App\Models\Torrent;

class Torrents extends Controller {

    public function __construct()
    {
        parent::__construct();
        // if (!$this->loggedIn()) {
        //     Redirect::to('/login');
        // }
    }

    public function __clone()
    {

    }

    public function index()
    {
        $this->view->title = SNAME . " :: Torrents";
        $this->view->load('torrents/index', false);
    }

    public function upload()
    {
        $this->view->title = SNAME . " :: Upload Torrent";
        $this->view->categories = Torrent::categories();
        $this->view->token = Token::generate();
        $this->view->load('torrents/upload', false);
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
