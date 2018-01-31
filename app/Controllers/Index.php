<?php

namespace App\Controllers;

class Index extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function __clone() {
        
    }

    public function index() {
        $this->view->title = "  :: Index";
        $this->view->load('index/index', true);
    }

}
