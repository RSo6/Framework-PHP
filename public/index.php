<?php

if (PHP_MAJOR_VERSION  <  8) {
    die('Необхідна версія PHP 8.0');
}

    require_once dirname(__DIR__) .  '/config/init.php';

new \wfm\app();

throw new Exception("Error occured");



//echo  $test;































