<?php

namespace App\Controllers;

use App\Libs\Redirect;
use App\Models\New;

class Home extends Controller {

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
        $this->view->title = SNAME . " :: Home";
        $this->view->news = New::all();
        $this->view->load("home/index", false);
    }

}
