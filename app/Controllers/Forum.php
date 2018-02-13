<?php

namespace App\Controllers;

use App\Libs\Redirect;

class Forum extends Controller {

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
        $this->view->title = SNAME . " :: Forum";
        $this->view->load("forum/index", false);
    }

    public function topic($slug = "")
    {
        $this->view->load("forum/topic", false);
    }

}
