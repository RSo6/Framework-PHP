<?php

namespace app\widgets\language;

use RedBeanPHP\R;
use wfm\App;

class Language
{

    protected $tpl;//тут зберігається шаблон(зовнішній вид) який реалізує данний віджет
    protected $languages;
    protected $language;   //тут зберігаємо всі наявні мови, з методу: public static function getLanguagesList(): array

    public function __construct()//тут ми зберігаємо поточну мову, яку вибрав користувач, з методу: public static function getLanguage($languages)
    {
        $this->tpl = __DIR__ . '/lang_tpl.php'; //шлях до шаблону
        $this->run();                           //викликаємо метод run
    }
    protected function run()
      //отримує $languages i $language;
    { //і записує в них інформацію про всі наявні мови та про поточну мову
        $this->languages = App::$app->getProperty('languages');//всі наявні мови
        $this->language = App::$app->getProperty('language');//поточна мова
        // і все це ми беремо з классу AppController
        echo $this->getHtml();
    }

    public static function getLanguagesList(): array
        //отримує повністю весь список мов,
    {   //метод getAssoc повертає ассоціативний массив,
        //дані із таблиці language в нашій DB,
        //ORDER BY base DESC - сортуємо(ORDER BY) ключ (base), (DESC)в зворотньому порядку
        return R::getAssoc("SELECT code, title, base, id FROM language ORDER BY base DESC");
    }

        //мови складуються в конструкторі в  класі AppController.php
    public static function getLanguage($languages)
        //отримує з url адресу (код мови), і повертає мову яка вибрана користувачем, також перевіряє чи є в наявності обрана мова
    {
        $lang = App::$app->getProperty('lang');//тут ми хочемо отримати з контейнера данні про мову
        if ($lang && array_key_exists($lang, $languages)) { //перевірка чи існує вибрана мова в списку доступних мов
            $key = $lang;//якщо мова існує то ми кладемо її в перемінну $key

        }   elseif (!$lang) { //перевірка якщо в нас немає вибраної користувачем мови
            $key = key($languages);//функція key забирає поточний ключ массиву,
            //тобто ми встановлюємо мову під замовчуванням яка знаходиться під ключем [base] => 1(в нашому випадку ua)

        } else {
            $lang = h($lang); //якщо мова не існує то викидуємо помилку
            throw new \Exception("Not found LanguageController {$lang}", 404);
        }
//        print_r($key);

        $lang_info = $languages[$key];//витягуємо всю інформацію про мову по коду $key
        $lang_info['code'] = $key;
        return $lang_info;// і повертаємо цю інформацію
    }

    protected function getHtml(): string
    {
        ob_start();//вмикаємо буферизацію виведення
        require_once $this->tpl;
        return ob_get_clean();
    }

}