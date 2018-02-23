<?php

namespace App\Controllers;

use App\Libs\Redirect;
use App\Models\Rule;

class Rules extends Controller
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
        $this->view->title = SNAME . " :: Rules";
        $this->view->rules = Rule::all();
        $this->view->load("rules/index", false);
    }

}
