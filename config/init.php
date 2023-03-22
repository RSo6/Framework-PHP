<?php

define("DEBUG", 1);
define("ROOT", dirname(__DIR__));
define("WWW", ROOT . '/public');
define("APP", ROOT . '/app');
define("CORE", ROOT . '/vendor/wfm');
define("HELPERS", ROOT . '/vendor/wfm/helpers');
define("CACHE", ROOT . '/tmp/cache');
define("LOGS", ROOT . '/tmp/logs');
define("CONFIG", ROOT . '/config');
define("LAYOUT", 'myshop');
define("PATH", 'http://new-myshop.loc');
define("ADMIN", 'http://new-myshop.loc/admin');
define("NO_IMAGE", 'uploads/no_images.jpg');

require_once ROOT . '/vendor/autoload.php';
