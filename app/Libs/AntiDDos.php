<?php

namespace App\Libs;

class AntiDDos {

    public function __construct()
    {
        $ip = Helper::getIP();

        $banned = file(ROOT . "data/logs/ip-banned.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        if (in_array($ip, $banned)) {
            header("Content-Type: text/html; charset=UTF-8");
            $body = file_get_contents(VIEWS . "ipblocked.php");
            echo str_replace("{{ip}}", $ip, $body);
            exit();
        }

        $file = file_get_contents(ROOT . "data/logs/ip.txt");
        $ips = unserialize($file);

        $ips["" . microtime(true) . ""] = $ip;
        $count = 0;

        foreach ($ips as $key => $value) {
            if ($value == $ip) {
                $count++;
            }
            if (microtime(true) - floatval($key) > 1) {
                unset($ips[$key]);
            }
        }

        if ($count > 10) {
            file_put_contents(ROOT . "data/logs/ip-banned.txt", $ip . "\r\n");
            if (isset($_COOKIE["hash"])) {
                file_put_contents(ROOT . "data/logs/ip-banned.txt", $_COOKIE["hash"] . "\r\n");
            }
        }

        file_put_contents(ROOT . "data/logs/ip.txt", serialize($ips));
    }

    private function __clone() { }

}
