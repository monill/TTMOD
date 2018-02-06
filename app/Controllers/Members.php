<?php

namespace App\Controllers;

use App\Libs\Redirect;
use App\Libs\Input;
use App\Libs\Token;
use App\Models\User;

class Members extends Controller {

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
        $this->view->title = SNAME . " :: Members";
        $this->view->token = Token::generate();
        $this->view->members = User::members();
        $this->view->load("members/index", false);
    }

    public function letter($l = "")
    {
        if (isset($l)) {

            $search = $this->db->select("SELECT * FROM `users` WHERE `username` LIKE :letter AND `status` = 'confirmed' AND `privacy` != 'private' ORDER BY `username` ASC", ["letter" => "$l%"]);

            if (count($search) > 0) {
                $this->view->title = SNAME . " :: Members with letter " . strtoupper($l);
                $this->view->token = Token::generate();
                $this->view->members = $search;
                $this->view->load("members/index", false);
            } else {
                $this->view->title = SNAME . " :: Members not found";
                $this->view->token = Token::generate();
                $this->view->members = $search;
                $this->view->load("members/index", false);
            }

        } else {
            Redirect::to("/members");
        }
    }

    public function search()
    {
        if (Input::exist())
        {
            $user = Input::get("user");
            $class = Input::get("class");

            if ($user || $class) {

                if (!$class) {
                    unset($class);
                }
                $search = $this->db->select("SELECT `id`, `username`, `class`, `created_at`, `estate_id` FROM `users` WHERE `username` LIKE :usern AND `class` = :clas AND `status` = 'confirmed' AND `privacy` != 'private' ORDER BY `username` ASC", ["usern" => "%$user%", "clas" => $class]);

                 if (count($search) > 0) {
                     $this->view->title = SNAME . " :: Member";
                     $this->view->token = Token::generate();
                     $this->view->members = $search;
                     $this->view->load("members/index", false);
                 } else {
                     $this->view->title = SNAME . " :: Member";
                     $this->view->token = Token::generate();
                     $this->view->members = $search;
                     $this->view->load("members/index", false);
                 }

            } else {
                Redirect::to("/members");
            }
        } else {
            Redirect::to("/members");
        }

    }

}
