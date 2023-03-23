<?php

if (PHP_MAJOR_VERSION  <  8) {
    die('Необхідна версія PHP 8.0');
}

    require_once dirname(__DIR__) .  '/config/init.php';

new \wfm\app();

//echo \wfm\app::$app->getProperty('pagination');
//\wfm\app::$app->setProperty('test','Test');
//var_dump(\wfm\app::$app->getProperties());

































