<?php

function debug($data, $die = false)
{
    echo '<pre>' . print_r($data, 1) . '</pre>';

    if ($die) {
        die;
    }
}

function h($str)
{
    return htmlspecialchars($str);
}

function redirect($http = false)
{
     if ($http) { //якщо переданий http
         $redirect = $http; //тоді ми в перемінну редірект записуєм цей http
     } else {//перевіка якщо в массиві сервер існує ключ http_referer(адрес з якого він прийшов) то в цьому випадку ми візьмем його
         $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;//інший випадок відправимо на головну сторінку
     }
     header("Location: $redirect");//робимо редірект на ту сторінку яка попала в перемінну редірект
     die;//закінчуємо наступне виконання коду
}


function baseUrl()
{
    // PATH = http://new-myshop.loc + / + en + / якщо такого нема то додамо пустий рядок
    return PATH . '/' .(\wfm\App::$app->getProperty('lang') ? \wfm\App::$app->getProperty('lang') . '/' : '');
}
/**
 * @param string $key key of GET array
 * @param string $type Value 'i', 'f, 's'
 * @return float|int|string
 */
//get('page')
//$_GET['page'}
function get($key, $type = 'i')
{
    $param = $key;
    $$param  = $_GET[$param] ?? '';//$page = $_GET['page'] ?? '';
    if ($type == 'i') {
        return (int)$$param;
    } elseif ($type == 'f') {
        return (float)$$param;
    } else {
        return trim($$param);
    }
}

/**
 * @param string $key key of POST array
 * @param string $type Value 'i', 'f, 's'
 * @return float|int|string
 */

function post($key, $type = 's')
{
    $param = $key;
    $$param = $_POST[$param] ?? '';
    if ($type == 'i') {
        return (int)$$param;
    } elseif ($type == 'f') {
        return (float)$$param;
    } else {
        return trim($$param);
    }
}