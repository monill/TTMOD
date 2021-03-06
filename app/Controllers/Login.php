<?php

namespace App\Controllers;

use App\Libs\Cookie;
use App\Libs\Helper;
use App\Libs\Input;
use App\Libs\Redirect;
use App\Libs\Session;
use App\Libs\Token;
use App\Libs\Validation;

class Login extends Controller
{
    private $loginFingerPrint = LOGIN_FINGERPRINT;
    public $valid;

    public function __construct()
    {
        parent::__construct();
        $this->valid = new Validation();
    }

    private function __clone() { }

    public function index()
    {
        $this->view->title = SNAME . " :: Login";
        $this->view->token = Token::generate();
        $this->view->load("auth/login", true);
    }

    public function in()
    {
        if (Input::exist())
        {
            $user = Input::get("username");
            $pass = Input::get("password");

            //checa brute force no login
            if ($this->bruteForce()) {
                Session::flash("danger", "Brute force detected.");
                Redirect::to("/login");
            }

            $validation = $this->validLogin($user, $pass);

            if (count($validation) == 0) {

                $sql = $this->db->select1("SELECT * FROM `users` WHERE `username` = :usern ", ["usern" => $user]);

                if (count($sql) == 1) {

                    $check = array();

                    if ($sql->status != "confirmed") {
                        $check[] = "Account not activated.";
                    }
                    if ($sql->banned != "no") {
                        $check[] = "Account banned.";
                    }
                    if (password_verify($pass, $sql->passwd) === false) {
                        $check[] = "Username or password not match.";
                    }

                    if (count($check) == 0) {
                        $points = $sql->points;

                        //start sessions
                        Session::set("loggedin", true);
                        Session::set("userid", (int) $sql->id);
                        Session::set("username", $sql->username);
                        Cookie::set(SNAME, $sql->username, 60480);

                        //se usuário ok, faz o login do piao e atualiza pontos
                        $this->updateLogin($sql->id, $points);

                        if ($this->loginFingerPrint == true) {
                            Session::set("login_fingerprint", $this->loginString());
                        }

                        Redirect::to("/home");
                    } else {
                        $this->triesLogin();
                        $result1 = ["status" => "error", "errors" => $check];
                        echo json_encode($result1);
                    }
                } else {
                    $this->triesLogin();
                    $result2 = ["status" => "error", "errors" => "Account or password invalid."];
                    echo json_encode($result2);
                }
            } else {
                $this->triesLogin();
                $result3 = ["status" => "error", "errors" => $validation];
                echo json_encode($result3);
            }
        } else {
            $this->triesLogin();
            Redirect::to("/login");
        }
    }

    public function validLogin($user, $pass)
    {
        $erro = array();

        if ($this->valid->isEmpty($user)) {
            $erro[] = "Please enter the account!";
        }
        if ($this->valid->isEmpty($pass)) {
            $erro[] = "Please enter the password!";
        }
        if (!$this->valid->userExist($user)) {
            $erro[] = "Username not exists...";
        }
        if (!ctype_alnum($user)) {
            $erro[] = "The username can only contain letters and numbers without space.";
        }
        return $erro;
    }

    public function bruteForce()
    {
        return $this->loginTries() > 10 ? true : false;
    }

    public function triesLogin()
    {
        //obtem o numero atual de tentativas daquele IP
        $logins = $this->loginTries();

        //se forem maiores que 0, atualiza o valor
        if ($logins > 0) {
            $this->db->update('bruteforces', ["alltimes" => $logins + 1], "`ip` = :ip AND `alldate` = :em", ["ip" => Helper::getIP(), "em" => Helper::data()]);
        } else {
            $this->db->insert('bruteforces', ["ip" => Helper::getIP(), "alldate" => Helper::data()]);
        }
    }

    public function updateLogin($userid, $points)
    {
        $this->db->update('users', [
            'lastlogin' => Helper::dateTime(),
            'points' => $points + 10,
            'ip' => Helper::getIP()
                ], 'id = :id', ["id" => (int) $userid]);
    }

    //======= PRIVATE AREA =======//
    /**
    * Generate a string that will be used as a fingerprint.
    * This is actually a string created from the user's browser name and the user's IP
    * Address, so if someone steals users session, he will not be able to access.
    * @return string generated string.
    */
    private function loginString()
    {
        $ip = Helper::getIP();
        $browser = Helper::browser();
        return hash("sha512", $ip, $browser);
    }

    private function loginTries()
    {
        $query = $this->db->select1("SELECT `alltimes` FROM `bruteforces` WHERE `ip` = :ipp AND `alldate` = :em", ["ipp" => Helper::getIP(), "em" => Helper::data()]);
        return count($query) == 0 ? 0 : $query->alltimes;
    }

}
