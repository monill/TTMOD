<?php

namespace App\Controllers;

use App\Libs\Redirect;

class Members extends Controller
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
        $this->view->title = SNAME . " :: Members";
        $this->view->load('members/index', false);
        exit();
    }
}
