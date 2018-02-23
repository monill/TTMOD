<?php

namespace App\Controllers;

use App\Libs\Redirect;
use App\Models\User;

class Staff extends Controller
{
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
        $this->view->title = SNAME . " :: Staff's";
        $this->view->staffs = User::staffs();
        $this->view->load("staff/index", false);
    }

}
