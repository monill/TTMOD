<?php

namespace App\Controllers;

use App\Libs\Email;
use App\Libs\Helper;
use App\Libs\Redirect;
use App\Libs\Token;
use App\Libs\Input;
use App\Libs\Validation;
use App\Models\Log;

class Invite extends Controller {

    public $valid;
    private $mailer;

    public function __construct()
    {
        parent::__construct();
        // if (!$this->loggedIn()) {
        //     Redirect::to("/login");
        // }
        $this->valid = new Validation();
        $this->mailer = new Email();
    }

    private function __clone() { }

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
        if (Input::exist())
        {
            $email = Input::get("email");

            //check for erros
            $error = $this->validInv($email);

            if (count($error) == 0)
            {
                $key = Helper::codeAtivacao();

                //TODO
                //finish all this
//                $this->db->insert('invites', [

//                ]);

                //$this->mailer->invite($email, $key);

                $msg = "An email successfully was send to {$email} to activate the account.";

                Log::create("A member with nick: <b> {user} </b> send a invite to email <b> {$email} </b>.");

                $resultado = ["status" => "success", "msg" => $msg];
                echo json_encode($resultado);
            } else {
                $result = ["status" => "error", "errors" => $error];
                echo json_encode($result);
            }

        } else {
            Redirect::to("/invite");
        }

    }

    public function validInv($email)
    {
        $errors = array();

        if ($this->valid->isEmpty($email)) {
            $errors[] = "Please enter an email.";
        }
        if ($this->valid->validEmail($email)) {
            $errors[] = "Please enter a valid email address.";
        }
        if ($this->valid->emailExist($email)) {
            $errors[] = "The email provided is already in use.";
        }
        return $errors;
    }

}
