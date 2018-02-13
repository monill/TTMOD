<?php

namespace App\Controllers;

use App\Libs\Helper;
use App\Libs\Redirect;
use App\Libs\Session;
use App\Libs\Views;
use App\Libs\Database;

class Controller {

    public $view = null;
    public $db;
    private $loginFingerPrint = LOGINFG;

    public function __construct()
    {
        $this->view = new Views();
        $this->db = Database::getInstance();
        $this->loggedIn();
    }

    private function __clone() { }

    public function loggedIn()
    {
        if ((Session::get("userid") || Session::get("loggedin")) == null) {
            return false;
        }

        if ($this->loginFingerPrint == true) {
            $loginString = $this->loginString();
            $stringNow = Session::get("login_fingerprint");

            if ($stringNow != null && $stringNow == $loginString) {
                return true;
            } else {
                //destroy session, it is probably stolen by someone
                $this->logout();
                return false;
            }
        }
        //if you got to this point, user is logged in
        return true;
    }

    //======= PRIVATE AREA =======//
    /**
            * Gerar uma string que será usada como impressão digital.
            * Esta é realmente uma string criada a partir do nome do navegador do usuário e do IP do usuário
            * Endereço, então, se alguém roubar sessão de usuários, ele não poderá acessar.
            * @return string string gerado.
            */
    private function loginString()
    {
        $ip = Helper::getIP();
        $browser = Helper::browser();
        return hash("sha512", $ip, $browser);
    }

    private function logout()
    {
        Session::destroySession();
        Redirect::to("/login");
    }

}
