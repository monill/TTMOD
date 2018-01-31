<?php

namespace App\Controllers;

use App\Libs\Redirect;

class Faq extends Controller {

    public function __construct() {
        parent::__construct();
        // if (!$this->loggedIn()) {
        //     Redirect::to('/login');
        // }
    }

    public function __clone() {
        
    }

    public function index() {
        $this->view->title = SNAME . " :: F.A.Q";
        $this->view->categs = \App\Models\Faq::categ();
        $this->view->answers = \App\Models\Faq::answer();
        $this->view->load('faq/index', false);
    }

}
