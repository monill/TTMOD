<?php

namespace App\Controllers;

use App\Libs\Email;
use App\Libs\Helper;
use App\Libs\Input;
use App\Libs\Redirect;
use App\Libs\Session;
use App\Libs\Token;
use App\Libs\Validation;
use App\Models\Estate;
use App\Models\Log;

class Signup extends Controller {

    private $mailer;
    public $valid;

    public function __construct()
    {
        parent::__construct();
        $this->mailer = new Email();
        $this->valid = new Validation();
    }

    public function __clone()
    {

    }

    public function index()
    {
        $this->view->title = SNAME . " :: Signup";
        $this->view->token = Token::generate();
        $this->view->estates = Estate::all();
        $this->view->load("auth/signup", true);
    }

    public function in()
    {
        if (Input::exist())
        {
            $user = Input::get("username");
            $pass = Input::get("password");
            $passagain = Input::get("passagain");
            $mail = Input::get("email");
            $dob = Input::get("dob");
            $estate = Input::get("estate");
            $gender = Input::get("gender");

            $data = explode("/", $dob);
            $data_ok = $data[2] . "/" . $data[1] . "/" . $data[0];

            //inicia validacao dos campos
            $erros = $this->validData($user, $mail, $pass, $passagain);

            //se 0 erros, inicia o cadastro
            if (count($erros) == 0) {
                $key = Helper::codeAtivacao();
                //TODO
                //fix this
                try {
                    $this->db->insert('users', [
                        'username' => $user,
                        'email' => $mail,
                        'passwd' => Helper::hashSenha($pass),
                        'dob' => $data_ok,
                        'codeactivation' => $key,
                        'ip' => Helper::getIP(),
                        'estate_id' => $estate,
                        'sex' => $gender,
                        'passkey' => Helper::md5Gen(),
                        'created_at' => Helper::dateTime()
                    ]);
                } catch (\Exception $exc) {
                    Session::flash("info", "There was an error creating your account.");
                    Redirect::to("/signup");
                    //die($exc->getMessage());
                }

                $this->mailer->confirmEmail($mail, $key);

                $msg = "Account created successfully check your email to activate your account, Inbox or SPAM.";

                Log::create("New member with nick: <b> {$user} </b> registered.");

                $resultado = ["status" => "success", "msg" => $msg];
                echo json_encode($resultado);
            } else {
                $result = ["status" => "error", "errors" => $erros];
                echo json_encode($result);
            }
        } else {
            Redirect::to("/signup");
        }
    }

    public function validData($user, $mail, $pass, $passagain)
    {
        $errors = array();

        if ($this->valid->isEmpty($user)) {
            $errors[] = "Please enter the account.";
        }
        if ($this->valid->isEmpty($mail)) {
            $errors[] = "Please enter an email.";
        }
        if ($this->valid->isEmpty($pass)) {
            $errors[] = "Please enter a password.";
        }
        if ($this->valid->isEmpty($passagain)) {
            $errors[] = "Please enter the second password.";
        }
        if ($pass != $passagain) {
            $errors[] = "The passwords do not match.";
        }
        if (strlen($pass) < 6 || strlen($passagain) > 16) {
            $errors[] = "Password must be between 6 and 16 characters long.";
        }
        if ($this->valid->validEmail($mail)) {
            $errors[] = "Please enter a valid email address.";
        }
        if ($this->valid->emailExist($mail)) {
            $errors[] = "The email provided is already in use.";
        }
        if ($this->valid->userExist($user)) {
            $errors[] = "The chosen username is already in use.";
        }
        if (strlen($user) < 3 && strlen($user) > 25) {
            $errors[] = "User can have between 3 and 25 characters.";
        }
        if (!ctype_alnum($user)) {
            $errors[] = "The username can only contain letters and numbers with no space.";
        }
        return $errors;
    }

}
