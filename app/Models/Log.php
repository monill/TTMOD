<?php

namespace App\Models;

use App\Libs\BrowserDetection;
use App\Libs\Database;
use App\Libs\Helper;

class Log extends Model {

    public function __construct()
    {
        parent::__construct();
    }

    private function __clone() { }

    public static function create($text)
    {
        $db = Database::getInstance();

        $browser = new BrowserDetection();

        return $db->insert('logs', [
                    'text' => Helper::escape($text),
                    'ip' => Helper::getIP(),
                    'browser' => $browser->getUserAgent(),
                    'os_system' => $browser->getPlatformVersion(),
                    'created_at' => Helper::dateTime()
        ]);
    }

}
