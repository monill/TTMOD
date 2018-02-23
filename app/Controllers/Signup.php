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

class Signup extends Controller
{
    private $mailer;
    private $valid;

    public function __construct()
    {
        parent::__construct();
        $this->mailer = new Email();
        $this->valid = new Validation();
    }

    private function __clone() { }

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
            if (Token::check(Input::get("token")))
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
                $erros = $this->validSign($user, $mail, $pass, $passagain);

                //se 0 erros, inicia o cadastro
                if (count($erros) == 0) {
                    $key = Helper::codeAtivacao();
                    //TODO
                    //fix this
                    try {
                        $this->db->insert('users', [
                            'username' => $user,
                            'email' => $mail,
                            'passwd' => Helper::hashPass($pass),
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
                echo "Invalid Token";
            }

        } else {
            Redirect::to("/signup");
        }
    }

    public function validSign($user, $mail, $pass, $passagain)
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

    public function activeacc($code)
    {
        if (isset($code))
        {
            if (strlen($code) != 40) {
                Redirect::to("/login");

            } else {

                $user = $this->db->select1("SELECT * FROM `users` WHERE `codeactivation` = :codeact", ["codeact" => $code]);

                if (isset($user->codeactivation) == $code)
                {
                    $this->db->update('users', [
                        'status' => 'confirmed',
                        'codeactivation' => null,
                        'actived_at' => Helper::dateTime(),
                    ], "`codeactivation` = :k", ["k" => $code]);

                    echo '<h4 class="text-success"> Confirmed email! </h4>';
                    echo '<h5 class="text-success"> Now you can do <a href="'. url("/login") . '"> Login </a> </h5>';

                    Log::create("User: {$user->username} just activated the account.");

                    $this->mailer->thanks($user->email);

                } else {
                    echo "<h5 class='text-error'> Activation key does not exist or account already activated. </h5>";
                }

            }

        } else {
            Redirect::to("/login");
        }

    }

    public function invite($code)
    {
        if (isset($code))
        {
            $inv = $this->db->select1("SELECT `code` FROM `invites` WHERE code = :cod", ["cod" => $code]);

            if (count($inv) == 1)
            {
                $this->view->title = SNAME . " :: Signup Invite";
                $this->view->token = Token::generate();
                $this->view->estates = Estate::all();
                $this->view->code = $code;
                $this->view->load("auth/invite", true);

            } else {
                echo "invalid code invitation";
            }

        } else {
            Redirect::to("/login");
        }

    }

    public function invin()
    {
        if (Input::exist())
        {
            if (Token::check(Input::get("token")))
            {
                $user = Input::get("username");
                $pass = Input::get("password");
                $passagain = Input::get("passagain");
                $code = Input::get("code");
                $dob = Input::get("dob");
                $estate = Input::get("estate");
                $gender = Input::get("gender");

                $data = explode("/", $dob);
                $data_ok = $data[2] . "/" . $data[1] . "/" . $data[0];

                //inicia validacao dos campos
                $erros = $this->validInv($user, $pass, $passagain);

                if (count($erros) == 0)
                {
                    $inv = $this->db->select1("SELECT * FROM `invites` WHERE code = :cod", ["cod" => $code]);

                    $key = Helper::codeAtivacao();
                    //TODO
                    //fix this
                    try {
                        $this->db->insert('users', [
                            'username' => $user,
                            'email' => $inv->email,
                            'passwd' => Helper::hashPass($pass),
                            'status' => 'confirmed',
                            'dob' => $data_ok,
                            'ip' => Helper::getIP(),
                            'estate_id' => $estate,
                            'sex' => $gender,
                            'passkey' => Helper::md5Gen(),
                            'created_at' => Helper::dateTime(),
                            'actived_at' => Helper::dateTime()
                        ]);
                    } catch (\Exception $exc) {
                        Session::flash("info", "There was an error creating your account.");
                        Redirect::to("/signup");
                        //die($exc->getMessage());
                    }

                    $idd = $this->db->lastInsertId("id");

                    $this->db->update('invites', [
                        'code' => null,
                        'expires_on' => null,
                        'accepted_by' => $idd,
                        'accepted_at' => Helper::dateTime(),
                        'update_at' => Helper::dateTime()
                    ], "`code` = :cod", ["cod" => $code]);

                    $this->mailer->thanks($inv->email);

                    $msg = "Account created successfully.";

                    Log::create("New member with nick: <b> {$user} </b> registered. Invited by {$inv->user_id}");

                    $resultado = ["status" => "success", "msg" => $msg];
                    echo json_encode($resultado);


                } else {
                    $result = ["status" => "error", "errors" => $erros];
                    echo json_encode($result);
                }
            }

        } else {
            Redirect::to("/login");
        }
    }

    public function validInv($user, $pass, $passagain)
    {
        $errors = array();

        if ($this->valid->isEmpty($user)) {
            $errors[] = "Please enter the account.";
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
