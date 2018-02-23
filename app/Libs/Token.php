<?php

namespace App\Libs;

use App\Libs\Session;

class Token
{
    public function __construct() { }

    private function __clone() { }

    public static function generate()
    {
        return Session::set("token", sha1(time()));
    }

    public static function check($token)
    {
        $tokenNome = "token";

        if (Session::get($tokenNome) && $token === Session::get($tokenNome)) {
            Session::destroy($tokenNome);
            return true;
        }
        return false;
    }

}
