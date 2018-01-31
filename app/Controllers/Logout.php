<?php

namespace App\Controllers;

use App\Libs\Session;
use App\Libs\Redirect;

class Logout extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __clone() { }

    public function index()
    {
        // if ($_SERVER['PHP_SELF'] != $_SERVER['REQUEST_URI']) die();
        Session::destroySession();
        Redirect::to('/login');
    }
}
