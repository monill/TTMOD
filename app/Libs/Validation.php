<?php

namespace App\Libs;

class Validation
{
    public $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function __clone() { }

    public function isEmpty($data)
    {
        if (is_array($data)) {
            return empty($data);
        } elseif ($data == '') {
            return true;
        } else {
            return false;
        }
    }

    public function validEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false){
            return false;
        }
        return true;
    }

    public function userExist($username)
    {
        $table = 'users';
        $column = 'username';
        return $this->exist($table, $column, $username);
    }

    public function emailExist($email)
    {
        $table = 'users';
        $column = 'email';
        return $this->exist($table, $column, $email);
    }

    public function userAlfNum($username)
    {
        return ctype_alnum($username) ? true : false;
    }

    public function validDate($date, $format ='Y-m-d')
    {
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    public function validKey($key)
    {
        if (strlen($key) != 40) {
            return false;
        }

        $result = $this->db->select("SELECT * FROM `users` WHERE `codeactivation` = :code", ["code" => $key]);

        if (count($result) !== 1) {
            return false;
        }

        if ($result->codeactivation == null) {
            return false;
        }

        return true;
    }

    private function exist($table, $column, $value)
    {
        $db = Database::getInstance();
        $result = $db->select("SELECT * FROM `$table` WHERE `$column` = :val", ["val" => $value]);
        return count($result) > 0 ? true : false;
    }


}
