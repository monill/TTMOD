<?php

header("Content-Type: text/html; charset=UTF-8");
header("X-Frame-Options: DENY");
header("X-Content-Type-Options: nosniff");
header("X-XSS-Protection: 1; mode=block");

ob_start();

//ROOT
define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
//Controllers
define('CTRL', ROOT . 'app' . DIRECTORY_SEPARATOR . 'Controllers' . DIRECTORY_SEPARATOR);
//Data
define('DATA', ROOT . 'data' . DIRECTORY_SEPARATOR);
//Views
define('VIEWS', ROOT . 'views' . DIRECTORY_SEPARATOR);
//Cache
define('CACHE', ROOT . 'data' . DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR);

require ROOT . 'config/config.php';
require ROOT . 'config/email.php';
require ROOT . 'app/functions.php';

if (file_exists(ROOT . 'vendor/autoload.php')) {
    require ROOT . 'vendor/autoload.php';
}

require ROOT . 'bootstrap/Autoload.php';
$app = new Autoload();
