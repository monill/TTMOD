<?php

namespace App\Libs;

use App\Libs\Database;

class Helper {

    public function __construct() { }

    private function __clone() { }

    public static function hashPass($pass)
    {
        return password_hash($pass, PASSWORD_BCRYPT);
    }

    public static function validIP($ip)
    {
        if (strtolower($ip) === "unknown") {
            return false;
        }
        // generate ipv4 network address
        $ip = ip2long($ip);
        // if the ip is set and not equivalent to 255.255.255.255
        if ($ip !== false && $ip !== -1) {
            // make sure to get unsigned long representation of ip due to discrepancies
            // between 32 and 64 bit OSes and signed numbers (ints default to signed in PHP)
            $ip = sprintf("%u", $ip);
            // do private network range checking
            if ($ip >= 0 && $ip <= 50331647) {
                return false;
            }
            if ($ip >= 167772160 && $ip <= 184549375) {
                return false;
            }
            if ($ip >= 2130706432 && $ip <= 2147483647) {
                return false;
            }
            if ($ip >= 2851995648 && $ip <= 2852061183) {
                return false;
            }
            if ($ip >= 2886729728 && $ip <= 2887778303) {
                return false;
            }
            if ($ip >= 3221225984 && $ip <= 3221226239) {
                return false;
            }
            if ($ip >= 3232235520 && $ip <= 3232301055) {
                return false;
            }
            if ($ip >= 4294967040) {
                return false;
            }
        }
        return true;
    }

    public static function getIP()
    {
        // check for shared internet/ISP IP
        if (!empty($_SERVER['HTTP_CLIENT_IP']) && self::validIP($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        }
        // check for IPs passing through proxies
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            // check if multiple ips exist in var
            if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') !== false) {
                $iplist = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);

                foreach ($iplist as $ip) {
                    if (self::validIP($ip)) {
                        return $ip;
                    }
                }
            } else {
                if (self::validIP($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                    return $_SERVER['HTTP_X_FORWARDED_FOR'];
                }
            }
        }
        if (!empty($_SERVER['HTTP_X_FORWARDED']) && self::validIP($_SERVER['HTTP_X_FORWARDED'])) {
            return $_SERVER['HTTP_X_FORWARDED'];
        }
        if (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && self::validIP($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])) {
            return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
        }
        if (!empty($_SERVER['HTTP_FORWARDED_FOR']) && self::validIP($_SERVER['HTTP_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_FORWARDED_FOR'];
        }
        if (!empty($_SERVER['HTTP_FORWARDED']) && self::validIP($_SERVER['HTTP_FORWARDED'])) {
            return $_SERVER['HTTP_FORWARDED'];
        }
        // return unreliable ip since all else failed
        return $_SERVER['REMOTE_ADDR'];
    }

    public static function escape($string)
    {
        return htmlentities($string, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Convert bytes to readable format
     *
     * @param $s
     *   integer: bytes
     * @param int $calc
     *   (optional) integer: decimal precision (default: 2)
     * @return string: formatted size
     */
    public static function makeSize($s, $calc = 2)
    {
        $size = [' B', ' kB', ' MB', ' GB', ' TB', ' PB', ' EB', ' ZB', ' YB'];
        for ($i = 1, $x = 0; $i <= count($size); $i++, $x++) {
            if ($s < pow(1024, $i) || $i == count($size)) {
                // Change 1024 to 1000 if you want 0.98GB instead of 1,0000MB
                return number_format($s / pow(1024, $x), $calc) . $size[$x];
            }
        }
    }

    public static function tempoDecorrido($datetime, $full = false)
    {
        $now = new \DateTime();
        $ago = new \DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = [
            'y' => 'ano',
            'm' => 'mês',
            'w' => 'semana',
            'd' => 'dia',
            'h' => 'hora',
            'i' => 'minuto',
            's' => 'segundo',
        ];
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }
        if (!$full) {
            $string = array_slice($string, 0, 1);
        }
        return $string ? implode(', ', $string) . ' atrás' : ' agora mesmo';
    }

    public static function escapeUrl($url)
    {
        $ret = '';
        for ($i = 0; $i < strlen($url); $i += 2) {
            $ret .= '&' . $url[$i] . $url[$i + 1];
        }
        return $ret;
    }

    public static function htmlsafechars($txt = '')
    {
        $txt = preg_replace("/&(?!#[0-9]+;)(?:amp;)?/s", '&amp;', $txt);
        $txt = str_replace(["<", ">", '"', "'"], ["&lt;", "&gt;", "&quot;", '&#039;'], $txt);
        return $txt;
    }

    public static function validID($id)
    {
        return is_numeric($id) && ($id > 0) && (floor($id) == $id) ? true : false;
    }

    public static function validINT($id)
    {
        return is_numeric($id) && (floor($id) == $id) ? true : false;
    }

    public static function browser()
    {
        return $_SERVER['HTTP_USER_AGENT'];
    }

    public static function codeAtivacao()
    {
        return sha1(time() . microtime());
    }

    public static function dateTime()
    {
        return date("Y-m-d H:i:s");
    }

    public static function md5Gen()
    {
        return md5(uniqid() . time() . microtime());
    }

    public static function data()
    {
        return date("Y-m-d");
    }

    public static function validFilename($name)
    {
        //only works with single ''
        return preg_match('/^[^\0-\x1f:\\\\\/?*\xff#<>|]+$/si', $name);
    }

    public static function sql_timestamp_to_unix_timestamp($s)
    {
        return mktime(substr($s, 11, 2), substr($s, 14, 2), substr($s, 17, 2), substr($s, 5, 2), substr($s, 8, 2), substr($s, 0, 4));
    }

    public static function gmtime()
    {
        return self::sql_timestamp_to_unix_timestamp(self::dateTime());
    }

    public static function rowCount($table, $suffix = '')
    {
        $ret = array();
        $db = Database::getInstance();
        $ret = $db->select("SELECT COUNT(*) FROM `$table` {$suffix}");
        $t = $ret[0];

        return json_encode($t);
    }

    public static function getGuests()
    {
        $past = self::gmtime();
        $db = Database::getInstance();
        $db->delete("guests", "time < :tim", ["tim" => $past]);

        return self::rowCount("guests");
    }

    public static function health($seeders, $leechers)
    {
        if ($leechers == 0 && $seeders == 0 || $leechers > 0 && $seeders == 0) {
            return 0;
        } elseif ($seeders > $leechers) {
            return 10;
        }

        $ratio = $seeders / $leechers * 100;

        if ($ratio > 0 && $ratio < 15) {
            return 1;
        } elseif ($ratio >= 15 && $ratio < 25) {
            return 2;
        } elseif ($ratio >= 25 && $ratio < 35) {
            return 3;
        } elseif ($ratio >= 35 && $ratio < 45) {
            return 4;
        } elseif ($ratio >= 45 && $ratio < 55) {
            return 5;
        } elseif ($ratio >= 55 && $ratio < 65) {
            return 6;
        } elseif ($ratio >= 65 && $ratio < 75) {
            return 7;
        } elseif ($ratio >= 75 && $ratio < 85) {
            return 8;
        } elseif ($ratio >= 85 && $ratio < 95) {
            return 9;
        } else {
            return 10;
        }
    }

    public static function plus7Days()
    {
        return date("Y-m-d", strtotime("+7 days"));
    }

}
