<?php

namespace App\Controllers;

use App\Libs\Helper;
use App\Libs\Redirect;
use App\Libs\Session;
use App\Libs\Views;
use App\Libs\Database;

class Controller
{
    public $view = null;
    public $db;
    private $loginFingerPrint = LOGIN_FINGERPRINT;

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

    private function logout()
    {
        Session::destroySession();
        Redirect::to("/login");
    }

}
