<?php

namespace App\Libs;

use PDO;
use PDOException;

class Database extends PDO {

    private $type = "mysql";
    private $host = "localhost";
    private $username = "root";
    private $passwd = "mysql";
    private $datab = "track";
    private static $instance;

    public function __construct() {
        try {
            parent::__construct($this->type . ':host=' . $this->host . ';dbname=' . $this->datab . ';charset=UTF8', $this->username, $this->passwd);
            // comente esta linha se você não quiser relatórios de erros
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->exec("SET CHARACTER SET utf8");
        } catch (PDOException $exc) {
            die("Connection error: " . $exc->getMessage());
        }
    }

    private function __clone() {

    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function select($sql, $array = [], $fetchMode = PDO::FETCH_OBJ) {
        $db = self::getInstance();

        $sth = $db->prepare($sql);

        foreach ($array as $key => $value) {
            $sth->bindValue(":$key", $value);
        }

        $sth->execute();
        return $sth->fetchAll($fetchMode);
    }

    public function select1($sql, $array = array()) {
        $db = self::getInstance();

        $sth = $db->prepare($sql);

        foreach ($array as $key => $value) {
            $sth->bindValue(":$key", $value);
        }

        $sth->execute();
        return $sth->fetchObject();
    }

    public function insert($table, $data = []) {
        $db = self::getInstance();

        ksort($data);

        $fileNames = implode('`, `', array_keys($data));
        $fieldValues = ':' . implode(', :', array_keys($data));

        $sth = $db->prepare("INSERT INTO $table (`$fileNames`) VALUES ($fieldValues)");

        foreach ($data as $key => $value) {
            $sth->bindValue(":$key", $value);
        }

        $sth->execute();
    }

    public function update($table, $data, $where, $whereBindArray = array()) {
        $db = self::getInstance();

        ksort($data);

        $fieldDetails = null;

        foreach ($data as $key => $value) {
            $fieldDetails .= "`$key` = :$key,";
        }

        $fieldDetails = rtrim($fieldDetails, ',');

        $sth = $db->prepare("UPDATE $table SET $fieldDetails WHERE $where");

        foreach ($data as $key => $value) {
            $sth->bindValue(":$key", $value);
        }

        foreach ($whereBindArray as $key => $value) {
            $sth->bindValue(":$key", $value);
        }

        $sth->execute();
    }

    public function delete($table, $where, $bind = [], $limit = 1) {
        $db = self::getInstance();

        $sth = $db->prepare("DELETE FROM $table WHERE $where LIMIT $limit");

        foreach ($bind as $key => $value) {
            $sth->bindValue(":$key", $value);
        }

        $sth->execute();
    }

}
