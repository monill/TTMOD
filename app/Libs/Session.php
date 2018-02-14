<?php

namespace App\Libs;

class Session {

    private $onlyCookies = false;
    private $siteNome = SNAME;
    private $sessionSecure = false;
    private $sessionHttpOnly = true;
    private $sessionRegenerateID = true;

    public function __construct() { }
    
    private function __clone() { }
    /**
     * Start session.
     */
    public static function startSession()
    {
        ini_set("session.use_only_cookies", false);
        //ini_set('session.cookie_domain', '.localhost');

        $cookieParams = session_get_cookie_params();
        session_set_cookie_params(
            $cookieParams["lifetime"],
            $cookieParams["path"],
            $cookieParams["domain"],
            false,
            true
        );
        //session_name(SNAME);

        session_start();
        session_regenerate_id(true);
    }

    /**
     * Destroy session.
     */
    public static function destroySession()
    {
        $_SESSION = array();

        $params = session_get_cookie_params();

        setcookie(
            session_name(),
            '',
            time() - 420000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
        session_destroy();
    }

    /**
     * Set session data.
     * @param mixed $key Key that will be used to store value.
     * @param mixed $value Value that will be stored.
     */
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Get data from $_SESSION variable.
     * @param mixed $key Key used to get data from session.
     * @param mixed $default This will be returned if there is no record inside
     * session for given key.
     * @return mixed Session value for given key.
     */
    public static function get($key, $default = null)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return $default;
        }
    }

    /**
    * Unset session data with provided key.
    * @param $key
    */
    public static function destroy($key) {
        if ( isset($_SESSION[$key]) ) {
            unset($_SESSION[$key]);
        }
    }

    public static function flash($nome, $mensagem = "")
    {
        if (self::exist($nome)) {
            $session = self::get($nome);
            self::delete($nome);
        } else {
            self::set($nome, $mensagem);
        }
        return $session;
    }

}
