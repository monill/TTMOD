<?php

namespace App\Controllers;

use App\Libs\Input;
use App\Libs\Redirect;

class Torrent extends Controller
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
            var_dump($_REQUEST);

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
