<?php

namespace app\widgets\language;

use RedBeanPHP\R;

class Language
{

    protected $tpl;//тут зберігається шаблон(зовнішній вид) який реалізує данний віджет
    protected $languages;
    //тут зберігаємо всі наявні мови, з методу: public static function getLangugesList(): array
    protected $language;
    //тут ми зберігаємо поточну мову, яку вибрав користувач, з методу: public static function getLanguage($languages)ж

    public function __construct()
    {
        $this->tpl = __DIR__ . 'lang_tpl.php'; //шлях до шаблону
        $this->run();
    }

    protected function run()
        //отримує $languages i $language;
    {
    }

    public static function getLangugesList(): array
        //отримує список мов
    {           //метод getAssoc повертає ассоціативний массив
                //дані із таблиці language в нашій DB
                //ORDER BY base DESC - сортуємо(ORDER BY) ключ base в зворотньому порядку(DESC)
        return R::getAssoc("SELECT code, title, base, id FROM language ORDER BY base DESC");
    }

    public static function getLanguage($languages)
        //отримує параметр з мовами, і повертає мову яка вибрана користувачем
    {
    }
}