<?php

namespace wfm;

class Language
{
    public static array $lang_data = []; //массив з всіма перевединими вислови сторінки
    public static array $lang_layout = []; //массив з перевединеми вислови шаблону
    public static array $lang_view = []; //массив з перевединими вислови виду



    public static function load($code, $view)// приймає код мови і вид, і завантажує переведені вислови в масиви зверху
    {
        $lang_layout = APP . "/languages/{$code}.php";
        $lang_view = APP . "/languages/{$code}/{$view['controller']}/{$view['action']}.php";
//        debug($lang_view,1);
        if (file_exists($lang_layout)) {
            self::$lang_layout = require_once $lang_layout;
        }
        if (file_exists($lang_view)) {
            self::$lang_view = require_once $lang_view;
        }
        self::$lang_data = array_merge(self::$lang_layout, self::$lang_view);

    }

    public static function get($key)// по ключу повертає переведені вислови
    {
        return self::$lang_data[$key] ?? $key;
    }
}