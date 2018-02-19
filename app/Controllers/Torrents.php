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
        //     Redirect::to("/login");
        // }
    }

    private function __clone() { }

    public function index()
    {
        $this->view->title = SNAME . " :: Torrents";
        $this->view->torrents = Torrent::all();
        $this->view->token = Token::generate();
        $this->view->load("torrents/index", false);
    }

    public function upload()
    {
        $this->view->title = SNAME . " :: Upload Torrent";
        $this->view->categories = Torrent::categories();
        $this->view->token = Token::generate();
        $this->view->load("torrents/upload", false);
    }


    public function search()
    {
        if (Input::exist())
        {
            $search = Input::get("search");

            $torrents = $this->db->select("SELECT torrents.id, torrents.anon, torrents.category_id, torrents.leechers, torrents.seeders, torrents.name,
                torrents.size, torrents.created_at, torrents.comments, torrents.uploader_id, torrents.freeleech, torrent_categories.name AS cat_name,
                torrent_categories.slug AS cat_slug, users.username FROM torrents LEFT JOIN torrent_categories ON category_id = torrent_categories.id LEFT JOIN
                users ON torrents.uploader_id = users.id WHERE torrents.name LIKE :tname ORDER BY name DESC", ["tname" => "%$search%"]);

            $this->view->title = SNAME . " :: Torrent search";
            $this->view->torrents = $torrents;
            $this->view->token = Token::generate();
            $this->view->load("torrents/index", false);
        } else {
            Redirect::to("/torrents");
        }
    }

    public function advsearch()
    {
        if (Input::exist())
        {
            $search = Input::get("search");
            if (!$search) {
                $search = "";
            }
            $categ = Input::get("categ");
            $incldead = Input::get("incldead");
            $freeleech = Input::get("freeleech");
            $inclext = Input::get("inclext");

            $torrents = $this->db->select("SELECT torrents.id, torrents.anon, torrents.category_id, torrents.leechers, torrents.seeders, torrents.name,
                torrents.size, torrents.created_at, torrents.comments, torrents.uploader_id, torrents.freeleech, torrent_categories.name AS cat_name,
                torrent_categories.slug AS cat_slug, users.username FROM torrents LEFT JOIN torrent_categories ON category_id = torrent_categories.id LEFT JOIN
                users ON torrents.uploader_id = users.id WHERE torrents.name LIKE :name AND torrents.category_id = :categ AND torrents.visible = :incldead AND torrents.freeleech = :freel AND torrents.external = :extern ORDER BY name DESC",
                ["name" => "%$search%", "categ" => $categ, "incldead" => $incldead, "freel" => $freeleech, "extern" => $inclext]);

            $this->view->title = SNAME . " :: Torrent search";
            $this->view->torrents = $torrents;
            $this->view->token = Token::generate();
            $this->view->load("torrents/index", false);

        } else {
            Redirect::to("/torrents");
        }
    }

    public function categ($slug = "")
    {
        if (isset($slug))
        {
            $tid = $this->db->select1("SELECT id FROM torrent_categories WHERE slug = :link", ["link" => $slug]);
            $id = $tid->id;

            $torrents = $this->db->select("SELECT torrents.id, torrents.anon, torrents.category_id, torrents.leechers, torrents.seeders,
                torrents.name, torrents.size, torrents.created_at, torrents.comments, torrents.uploader_id, torrents.freeleech, torrent_categories.name AS cat_name,
                torrent_categories.slug AS cat_slug, users.username FROM torrents LEFT JOIN torrent_categories ON category_id = torrent_categories.id LEFT JOIN users ON torrents.uploader_id = users.id WHERE torrents.category_id = :cid", ["cid" => $id]);

            $this->view->title = SNAME . " :: Torrent category";
            $this->view->torrents = $torrents;
            $this->view->token = Token::generate();
            $this->view->load("torrents/index", false);

        } else {
            Redirect::to("/torrents");
        }

    }

    public function import()
    {
        $dir = DATA . "import/";

        $files = array();
        $dh = opendir("$dir");

        while (false !== ($file = readdir($dh))) {
            if (preg_match("/^(.+)\.torrent$/si", $file)) {
                $files[] = $file;
            }
        }
        closedir($dh);

        $this->view->title = SNAME . " :: Upload/Import Torrents";
        $this->view->categories = Torrent::categories();
        $this->view->token = Token::generate();
        $this->view->files = $files;
        $this->view->load("torrents/import", false);
    }

    public function completes($id)
    {
        //TODO
        //finish this
        echo $id . "<br>";
        $this->view->title = SNAME . " :: Torrent completes";
        //$this->view->torrents = $torrents;
        //$this->view->token = Token::generate();
        $this->view->load("torrents/completed", false);
    }

    public function reseed($id)
    {
        //TODO
        //finish this
        //send a notification to users to reseed a completed torrent
        echo $id . "<br>";
    }
}
