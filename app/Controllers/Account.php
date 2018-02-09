<?php

namespace App\Controllers;

use App\Libs\Redirect;
use App\Models\Estate;

class Account extends Controller {

    //TODO
    //fix all user id in the functions

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
        $user = $this->db->select1("SELECT `username`, `class`, `email`, `active_at`, `dob`, `sex`, `donated`, `title`, `privacy`, `signature`, `passkey` FROM `users` WHERE `id` = :id", ["id" => (int) 7]);
        $this->view->title = SNAME . " :: Your CPanel";
        $this->view->user = $user;
        $this->view->load("account/index", false);
    }

    public function edit()
    {
        $this->view->title = SNAME . " :: Your CPanel";
        //$this->view->user = $user;
        $this->view->estates = Estate::all();
        $this->view->load("account/edit", false);
    }

    public function changepw()
    {
        $this->view->title = SNAME . " :: Your CPanel";
        $this->view->load("account/changepwd", false);
    }

    public function mytorrents()
    {
        $myts = $this->db->select("SELECT torrents.id, torrents.category_id, torrents.name, torrents.created_at, torrents.downs, torrents.banned, torrents.comments, torrents.seeders, torrents.leechers, torrents.times_completed, torrent_categories.name AS catname FROM torrents LEFT JOIN torrent_categories ON torrents.category_id = torrent_categories.id WHERE torrents.uploader_id = :uploader ORDER BY torrents.created_at DESC", ["uploader" => (int) 7]);
        $this->view->title = SNAME . " :: Your CPanel";
        $this->view->mytors = $myts;
        $this->view->load("account/mytorrents", false);
    }

}
