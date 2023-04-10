<?php

namespace app\controllers;

use wfm\App;

class LanguageController extends AppController
{

    public function changeAction()
    {
        $lang = $_GET['lang'] ?? null;//txt N:2
        if ($lang) { //txt N:3
            if (array_key_exists($lang, App::$app->getProperty('languages'))) { //txt N:4;
                $url = trim(str_replace
                (//txt N:5;
                    PATH,'',
                    $_SERVER['HTTP_REFERER']),
                    '/'
                );
                $url_parts = explode( //txt N:6
                    '/',
                    $url,
                    2
                );
                if (array_key_exists($url_parts[0], App::$app->getProperty('languages'))) {//txt N:7
                    if ($lang != App::$app->getProperty('language')['code']) {
                        $url_parts[0] = $lang;
                    } else {
                        //якщо це базова мова - видалимо її з  url
                        array_shift($url_parts);
                    }
                } else {
                    //присвоюєм першій частині нову мову, якщо вона не є базовим
                    if ($lang != App::$app->getProperty('language')['code']){
                        array_unshift($url_parts, $lang);
                    }
                }
                $url = PATH . '/' . implode('/', $url_parts);
                redirect($url);
            }
        }
        redirect();//в поганому випадку перекидає на головну сторінку

    }

}