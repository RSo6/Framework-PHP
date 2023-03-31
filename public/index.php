<?php

if (PHP_MAJOR_VERSION < 8) {
    die('Необхідна версія PHP 8.0');
}

require_once dirname(__DIR__) . '/config/init.php';
require_once HELPERS . '/functions.php';
require_once CONFIG . '/routes.php';

new \wfm\app();

//throw new Exception("Error was occured");
//echo "hello";


//debug(\wfm\Router::getRoutes());





















