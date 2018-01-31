<?php

namespace App\Controllers;

use App\Libs\Redirect;

class Chat extends Controller
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
        $this->view->title = SNAME . " :: Chat";
        $this->view->load('chat/index', false);
    }
}
