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

    private function __clone() { }

    public function index()
    {
        $staffs = $this->db->select("SELECT `id`, `username`, `class` FROM `users` WHERE `status` = 'confirmed' AND `class` IN ('moderator', 'moderatorplus', 'admin') ORDER BY `username` ASC");
        var_dump($staffs);
        $this->view->title = SNAME . " :: Staff's";
        $this->view->staffs = $staffs;
        $this->view->load("staff/index", false);
    }

}
