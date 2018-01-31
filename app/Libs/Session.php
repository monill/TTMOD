<?php

namespace App\Libs;

class Session {

    private $onlyCookies = false;
    private $siteNome = SNAME;
    private $sessionSecure = false;
    private $sessionHttpOnly = true;
    private $sessionRegenerateID = true;

    public static function startSession() {
        ini_set('session.use_only_cookies', false);

        $cookieParams = session_get_cookie_params();
        session_set_cookie_params(3600, $cookieParams["path"], $cookieParams["domain"], false, true);
        session_name(SNAME);

        session_start();
        session_regenerate_id(true);
    }

    public static function destroySession() {
        $_SESSION = [];
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 420000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
        session_destroy();
    }

    public static function exist($nome) {
        return (isset($_SESSION[$nome])) ? true : false;
    }

    public static function set($nome, $valor) {
        return $_SESSION[$nome] = $valor;
    }

    public static function get($nome, $default = null) {
        if (self::exist($nome)) {
            return $_SESSION[$nome];
        } else {
            return $default;
        }
    }

    public static function delete($nome) {
        if (self::exist($nome)) {
            unset($_SESSION[$nome]);
        }
    }

    public static function flash($nome, $mensagem = "") {
        if (self::exist($nome)) {
            $session = self::get($nome);
            self::delete($nome);
        } else {
            self::set($nome, $mensagem);
        }
        return $session;
    }

}
