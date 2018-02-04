<?php

namespace App\Libs;

use App\Libs\Session;

class Token {

    public function __construct()
    {

    }

    public function __clone()
    {

    }

    public static function generate()
    {
        return Session::set("token", sha1(uniqid()));
    }

    public static function check($token)
    {
        $tokenNome = "token";

        if (Session::exist($tokenNome) && $token === Session::get($tokenNome)) {
            Session::delete($tokenNome);
            return true;
        }
        return false;
    }

}
