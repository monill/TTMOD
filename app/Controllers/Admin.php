<?php

namespace App\Controllers;

use App\Libs\Redirect;

class Admin extends Controller
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
        $this->view->title = SNAME . " :: Admin Control Panel";
        $this->view->load('admin/index', false);
        exit();
    }
}
