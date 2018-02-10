<?php

namespace App\Controllers;

use App\Libs\Database;
use App\Libs\Helper;
use App\Libs\Torrent\MegaScrape;

class Index extends Controller {

    private $megaScrape;

    public function __construct()
    {
        parent::__construct();
        $this->megaScrape = new MegaScrape();
    }

    public function __clone()
    {

    }

    public function index()
    {
        $this->guestAdd();
        $this->megaScrape->tor();
        $this->view->title = "  :: Index";
        $this->view->load("index/index", true);
    }

    private function guestAdd()
    {
        $db = Database::getInstance();
        $ip = Helper::getIP();
        $time = Helper::gmtime();
        $g = $db->prepare("INSERT INTO `guests` (`ip`, `time`) VALUES ('{$ip}', '{$time}') ON DUPLICATE KEY UPDATE `time` = '{$time}'");
        return $g->execute();
    }

}
