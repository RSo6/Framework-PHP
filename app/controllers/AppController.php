<?php


namespace app\controllers;


use app\models\AppModel;
use app\widgets\language\Language;
use wfm\App;
use wfm\Controller;

class AppController extends Controller
{

    public function __construct($route)
    {
        parent::__construct($route);
        new AppModel();

        App::$app->setProperty('languages', Language::getLanguagesList());
        App::$app->setProperty('language', Language::getLanguage(App::$app->getProperty('languages')));

        $lang = App::$app->getProperty('language');
//        debug($lang);
        \wfm\Language::load($lang['code'], $this->route);

    }

}