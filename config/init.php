<?php

define("DEBUG", 1); //константа DEBUG відповідає за режим роботи нашого прилож
define("ROOT", dirname(__DIR__)); //константа ROOT веде на корінь прилож
define("WWW", ROOT . '/public'); //константа WWW-в якій зберіг.шлях до папки public.
define("APP", ROOT . '/app');
define("CORE", ROOT . '/vendor/wfm'); //константа WWW-в якій зберіг.шлях до папки public.
define("HELPERS", ROOT . '/vendor/wfm/helpers'); //константа HELPERS - класи,ф-ї помічники
define("CACHE", ROOT . '/tmp/cache'); //шлях до кеш
define("LOGS", ROOT . '/tmp/logs');
define("CONFIG", ROOT . '/config');
define("LAYOUT", 'myshop'); //шаблон сайта по замовчув.
define("PATH", 'http://new-myshop.loc'); //адрес сайта
define("ADMIN", 'http://new-myshop.loc/admin'); //адрес сайта адміна
define("NO_IMAGE", '/public/uploads/no_image.jpg'); //шлях до карт.якщо нема фото товара

require_once ROOT . '/vendor/autoload.php'; //підключаєм автозагрузчик
