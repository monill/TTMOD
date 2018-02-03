<?php

namespace App\Controllers;

use App\Libs\Redirect;
use App\Models\Rules;

class Rules extends Controller {

    public function __construct()
    {
        parent::__construct();
        // if (!$this->loggedIn()) {
        //     Redirect::to('/login');
        // }
    }

    public function __clone()
    {

    }

    public function index()
    {
        $this->view->title = SNAME . " :: Rules";
        $this->view->rules = Rules::all();
        $this->view->load('rules/index', false);
    }

}
