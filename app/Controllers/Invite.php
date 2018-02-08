<?php

namespace App\Controllers;

use App\Libs\Redirect;
use App\Libs\Token;
use App\Libs\Input;

class Invite extends Controller {

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
        $invs = $this->db->select1("SELECT `invites` FROM `users` WHERE `id` = :uid AND `status` = 'confirmed' AND `banned` = 'no'", ["uid" => 7]);
        $inv = (int)$invs->invites;

        $this->view->title = SNAME . " :: Invites";
        $this->view->token = Token::generate();
        $this->view->invs = $inv;
        $this->view->load("invite/index", false);
    }

    public function in()
    {
        $email = Input::get("email");

        echo $email;
    }

}
