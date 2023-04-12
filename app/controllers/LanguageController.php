<?php

namespace app\controllers;

use wfm\App;

class LanguageController extends AppController
{

    public function changeAction()
    {//txt N:2
 // lang = код мови(lang=en)
        $lang = get('lang', 's');
//        debug($lang, 1);
        if ($lang) { //txt N:3 , якщо щось прийшло в $lang
            if (array_key_exists($lang, App::$app->getProperty('languages')) && isset($_SERVER['HTTP_REFERER'])) { //txt N:4; перевіка чи є наш lang(ключ) в спискові доступних мов
                $url = trim(str_replace
                (//txt N:5;
                    PATH,'',//замінили PATH на пустий рядок
                    $_SERVER['HTTP_REFERER']),//з цього адресу ми прийшли
                    '/' //trimнули слеші
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