<?php

namespace app\controllers;

use app\models\Main;
use RedBeanPHP\R;
use wfm\App;


/** @property Main $model */
class MainController extends AppController
{
    public function indexAction()
    {
//        debug(App::$app->getProperty('language'));
        $lang = App::$app->getProperty('language');
        $slides = R::findAll('slider');
        $products = $this->model->get_hits($lang, 3);
//        debug($products,1);
        $this->set(compact('slides', 'products'));
        $this->setMeta('MainPage', 'description...', 'keywords...');
    }
}






