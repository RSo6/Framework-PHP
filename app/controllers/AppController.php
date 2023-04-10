<?php

namespace app\controllers;

use app\models\AppModel;

use app\widgets\language\Language;
use wfm\App;
use wfm\Controller;

class AppController extends Controller
{
    public function __construct($route) //викликаємо метод констуктора з класса Controller folder vendor\wfm;
    {
        parent::__construct($route);
        new AppModel();
        //Всі мови у нас будуть знаходитись в контейнері
        //setProperty - функція яка дозволяє записати щось в контейнер, у нашому випадку це всі мови
        //і массив мов повертає метод віджета getLanguagesList - список мов
        App::$app->setProperty('languages', Language::getLanguagesList());//тут всі доступні мови для користувача
        // ⊻ тут буде знаходитись мова по замовчуванню або так що вибрав кінцевий користувач
        App::$app->setProperty('language', Language::getLanguage(App::$app->getProperty('languages')));
//        debug(App::$app->getProperty('languages'));
//        debug(App::$app->getProperty('languages'));
//        debug(App::$app->getProperty('language'));
    }

}