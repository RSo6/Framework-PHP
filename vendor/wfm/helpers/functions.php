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
     if ($http) {
         $redirect = $http;
     } else {
         $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
     }
     header("Location: $redirect");
     die;
}


function baseUrl()
{
    // PATH = http://new-myshop.loc + / + en + / якщо такого нема то додамо пустий рядок
    return PATH . '/' .(\wfm\App::$app->getProperty('lang') ? \wfm\App::$app->getProperty('lang') . '/' : '');
}



