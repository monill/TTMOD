<?php

namespace App\Libs\Torrent;

use \Exception;

class ScraperException extends Exception {

    private $connectionerror;

    public function __construct($message, $code = 0, $connectionerror = false) {
        $this->connectionerror = $connectionerror;
        parent::__construct($message, $code);
    }

    public function isConnectionError() {
        return($this->connectionerror);
    }

}
