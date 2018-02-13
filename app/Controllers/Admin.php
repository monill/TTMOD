<?php

namespace App\Controllers;

use App\Libs\Redirect;

class Admin extends Controller {

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
        $this->view->title = SNAME . " :: Admin CPanel";
        $this->view->load("admin/index", false);
    }

}
