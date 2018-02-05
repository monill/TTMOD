<?php

namespace App\Controllers;

use App\Libs\Redirect;

class User extends Controller {

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
        $this->view->title = SNAME . " :: User";
        $this->view->load("staff/index", false);
    }

    public function id($id = "")
    {
        echo $id;
    }

}
