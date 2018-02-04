<?php

namespace App\Controllers;

use App\Libs\Redirect;
use App\Models\Faq as Faqs;

class Faq extends Controller {

    public function __construct()
    {
        parent::__construct();
        // if (!$this->loggedIn()) {
        //     Redirect::to("/login");
        // }
    }

    public function __clone()
    {

    }

    public function index()
    {
        $this->view->title = SNAME . " :: F.A.Q";
        $this->view->categs = Faqs::categ();
        $this->view->answers = Faqs::answer();
        $this->view->load("faq/index", false);
    }

}
