<?php

// Website URL
define('URL', 'http://kaihou.com');
// App root
define('RUT', $_SERVER['DOCUMENT_ROOT']);
// Page name
define('PNAME', 'Mobile');
// Server name
define('SNAME', 'TTMOD');

// Password key security, dont change this after install
define('PWD_KEY', '!@#Mobiorum^&*');

define('ANNOUNCE', URL . '/announce');
define('TUPLOAD', ROOT . 'data/torrents/');

// Set timezone
date_default_timezone_set('America/Sao_Paulo');

error_reporting(E_ALL); //^ E_NOTICE
ini_set("display_errors", true);
ini_set("log_errors", true);
ini_set("error_log", RUT . "/data/logs/php-error.txt");

// TRANSLATION
define('DEFAULT_LANGUAGE', 'en');
