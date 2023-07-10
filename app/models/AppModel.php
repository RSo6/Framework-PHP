<?php


namespace app\models;


use wfm\Model;
use RedBeanPHP\R;
class AppModel extends Model
{

    public static function createSlug($table, $field, $str, $id): string
        //створення слагу(1-назва таблиці, 2-назва поля, 3-назва категорії, 4-айді запису)
    {
        $str = self::str2url($str);//
        $res = R::findOne($table, "$field = ?", [$str]);//знаходимо наш слаг в переданій таблиці
        if ($res) { //якщо слаг уже існує
            $str = "{$str}-{$id}";//до слагу пристиковуємо айді категорії
            $res = R::count($table, "$field = ?", [$str]);//уже з приліпленим айді ще раз шукаємо слаг в таблиці
            if ($res) {//якщо ж існує слаг з приліпленим айді
                $str = self::createSlug($table, $field, $str, $id);//повторно викликаємо метод
            }
        }
        return $str;
    }

    public static function str2url($str): string
    {
        // переводимо в транслит
        $str = self::ua2translit($str);
        // в нижній регистр
        $str = strtolower($str);
        // заменям все ненужное нам на "-"
        $str = preg_replace('~[^-a-z0-9]+~u', '-', $str);
        // удаляемо початкові і кінцеві '-'
        $str = trim($str, "-");
        return $str;
    }

    public static function ua2translit($string): string
    {

        $converter = array(

            'а' => 'a', 'б' => 'b', 'в' => 'v',

            'г' => 'g', 'д' => 'd', 'е' => 'e',

             'ж' => 'zh', 'з' => 'z',

            'и' => 'i', 'й' => 'y', 'к' => 'k',

            'л' => 'l', 'м' => 'm', 'н' => 'n',

            'о' => 'o', 'п' => 'p', 'р' => 'r',

            'с' => 's', 'т' => 't', 'у' => 'u',

            'ф' => 'f', 'х' => 'h', 'ц' => 'c',

            'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch',

            'ь' => '\'', 'ъ' => '\'',

            'э' => 'e', 'ю' => 'yu', 'я' => 'ya',


            'А' => 'A', 'Б' => 'B', 'В' => 'V',

            'Г' => 'G', 'Д' => 'D', 'Е' => 'E',

             'Ж' => 'Zh', 'З' => 'Z',

            'И' => 'I', 'Й' => 'Y', 'К' => 'K',

            'Л' => 'L', 'М' => 'M', 'Н' => 'N',

            'О' => 'O', 'П' => 'P', 'Р' => 'R',

            'С' => 'S', 'Т' => 'T', 'У' => 'U',

            'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',

            'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sch',

            'Ь' => '\'',  'Ъ' => '\'',

            'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya',

        );

        return strtr($string, $converter);//strtr - перетворює задані символи або замінює підрядки

    }
}