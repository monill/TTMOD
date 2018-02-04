<?php

namespace App\Controllers;

use App\Libs\Redirect;

class Staff extends Controller {

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
        $staffs = $this->db->select("SELECT `id`, `username`, `class` FROM `users` WHERE `status` = 'confirmed' AND `class` IN ('moderator', 'moderatorplus', 'admin') ORDER BY `username` ASC");
        $this->view->title = SNAME . " :: Staff";
        $this->view->staffs = $staffs;
        $this->view->load("staff/index", false);
    }

}
