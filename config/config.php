<?php

// Website URL
define('URL', 'http://localhost');
// App root
define('RUT', $_SERVER['DOCUMENT_ROOT']);
// Page name
define('PNAME', 'Mobile');
// Server name
define('SNAME', 'Test..');

// Password key security, dont change this after install
define('PWD_KEY', '!@#Mobiorum^&*');

define('ANNOUNCE', URL . DIRECTORY_SEPARATOR .'announce' . DIRECTORY_SEPARATOR);
define('TUPLOAD', ROOT . 'data/torrents/');

// Set timezone
date_default_timezone_set('America/Sao_Paulo');

error_reporting(E_ALL); //^ E_NOTICE
ini_set("display_errors", true);
ini_set("log_errors", true);
ini_set("error_log", RUT . "/data/logs/php-error.txt");

//Login fringer printer
define('LOGINFG', false);
