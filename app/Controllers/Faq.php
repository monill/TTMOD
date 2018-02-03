<?php

namespace App\Controllers;

use App\Libs\Redirect;
use App\Models\Faq;

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
        $this->view->categs = Faq::categ();
        $this->view->answers = Faq::answer();
        $this->view->load('faq/index', false);
    }

}
