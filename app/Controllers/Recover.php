<?php

namespace App\Controllers;

use App\Libs\Email;
use App\Libs\Helper;
use App\Libs\Input;
use App\Libs\Redirect;
use App\Libs\Token;
use App\Libs\Validation;
use App\Models\Log;

class Recover extends Controller {

    private $mailer;
    private $login;
    private $valid;

    public function __construct()
    {
        parent::__construct();
        $this->mailer = new Email();
        $this->login = new Login();
        $this->valid = new Validation();
    }

    private function __clone() { }

    public function index()
    {
        $this->view->title = SNAME . " :: Recover Password";
        $this->view->token = Token::generate();
        $this->view->load("recover/index", true);
    }

    public function in()
    {
        if (Input::exist())
        {

            $email = Input::get("email");

            $errors = $this->validEmail($email);

            if ($this->login->bruteForce()) {
                die("BruteForce detected.");
            }

            $key = Helper::codeAtivacao();
            $ip = Helper::getIP();

            if (count($errors) == 0) {
                $this->db->update('users', [
                    'codeactivation' => $key,
                    'confirmresetpwd' => 'no',
                    'resetpwd_at' => Helper::dateTime(),
                    'ip' => $ip
                ], "`email` = :email", ["email" => $email]
                );

                //send the email
                $this->mailer->resetPass($email, $key);

                //log active
                Log::create("User with an email: {$email} requested password reset.");

                $msg = "Check your email to reset your password, Inbox or SPAM.";

                $result = ["status" => "success", "msg" => $msg];
                echo json_encode($result);
            } else {
                //increment bruteForce
                $this->login->triesLogin();
                Redirect::to("/login");
                echo json_encode($errors);
            }
        } else {
            Redirect::to("/login");
        }
    }

    public function code($key = "")
    {
        if (isset($key)) {
            if ($this->valid->validKey($key)) {
                $this->view->title = SNAME . " :: Recover Password";
                $this->view->token = Token::generate();
                $this->view->coding = $key;
                $this->view->load("recover/recover", true);
            } else {
                //echo "<h5 class='text-error' style='text-align: center;'> Reset key is invalid or already used. </h5>";
                Redirect::to("/recover");
            }
        } else {
            Redirect::to("/signup");
        }
    }

    public function on()
    {
        if (Input::exist())
        {
            $pwd = Input::get("password");
            $pwd1 = Input::get("password1");
            $key = Input::get("coding");

            $error = $this->validPass($pwd, $pwd1, $key);

            if (count($error) == 0) {
                $user = $this->db->select1("SELECT `username` FROM `users` WHERE `codeactivation` = :k", ["k" => $key]);

                $this->db->update('users', [
                    'passwd' => Helper::hashSenha($pwd),
                    'confirmresetpwd' => 'yes',
                    'codeactivation' => null,
                    'updated_at' => Helper::dateTime()
                ], "`codeactivation` = :prk", ["prk" => $key]);

                Log::create("User: {$user->username} changed the password successfully.");

                $reultado = ["status" => "sucess", "msg" => "Password changed successfully!"];
                echo json_encode($reultado);
            } else {
                $result = ["status" => "error", "error" => $error];
                echo json_encode($result);
            }
        } else {
            Redirect::to("/signup");
        }
    }

    public function acc($code = "")
    {
        if (isset($code))
        {
            if ($this->valid->validKey($code)) {
                $user = $this->db->select1("SELECT `username` FROM `users` WHERE `codeactivation` = :k", ["k" => $code]);

                $this->db->update('users', [
                    'status' => 'confirmed',
                    'codeactivation' => null,
                    'active_at' => Helper::dateTime()
                ], "`codeactivation` = :code", ["code" => $code]);

                Log::create("User: {$user->username} just activated the account.");

                $msg = "<h4 class='text-success'> Email Confirmed! </h4>";
                $msg .= "<h5 class='text-success'> You can now Login!! Welcome :D </h5>";
            } else {
                $msg = "<h5 class='text-error'> Activation key does not exist or account already activated. </h5>";
            }
        } else {
            Redirect::to("/signup");
        }
    }

    public function validEmail($email)
    {
        $errors = array();

        if ($this->valid->isEmpty($email)) {
            $errors[] = "Blank email is not worth.";
        }
        if (!$this->valid->validEmail($email)) {
            $errors[] = "Invalid email.";
        }
        if (!$this->valid->emailExist($email)) {
            $errors[] = "Informed email not found.";
        }
        return $errors;
    }

    public function validPass($pwd, $pwd1, $key)
    {
        $errors = array();

        if ($this->valid->isEmpty($pwd)) {
            $errors[] = "Please enter a password.";
        }
        if ($this->valid->isEmpty($pwd1)) {
            $errors[] = "Please enter the second password.";
        }
        if ($pwd != $pwd1) {
            $errors[] = "The passwords do not match.";
        }
        if (strlen($pwd) < 6 || strlen($pwd1) > 16) {
            $errors[] = "Password must be from 6 to 16 characters.";
        }
        if (!$this->valid->validKey($key)) {
            $errors[] = "Reset code invalid.";
        }
        return $errors;
    }

}
