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

    public function __clone()
    {

    }

    public function index()
    {
        $torrents = $this->db->select("SELECT torrents.id, torrents.anon,
            torrents.announce, torrents.category_id, torrents.leechers, torrents.nfo, torrents.seeders,
            torrents.name, torrents.times_completed, torrents.size, torrents.created_at, torrents.comments,
            torrents.numfiles, torrents.filename, torrents.uploader_id, torrents.external,
            torrents.freeleech, torrent_categories.name AS cat_name, users.username, users.privacy FROM torrents LEFT JOIN torrent_categories ON category_id = torrent_categories.id LEFT JOIN users ON torrents.uploader_id = users.id");
        $this->view->title = SNAME . " :: Torrents";
        $this->view->torrents = $torrents;
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
        } else {
            Redirect::to("/torrents");
        }
    }

    public function advsearch()
    {
        if (Input::exist())
        {

        } else {
            Redirect::to("/torrents");
        }
    }

    public function categ($slug = "")
    {
        echo "<br />" . $slug;
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

}
