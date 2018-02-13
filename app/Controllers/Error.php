<?php

namespace App\Controllers;

class Error extends Controller {

    public function __construct()
    {
        parent::__construct();
    }

    private function __clone() { }

    public function index()
    {
        $this->view->title = SNAME . " :: 404";
        $this->view->load("errors/404", true);
    }

}
