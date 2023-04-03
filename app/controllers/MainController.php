<?php

namespace app\controllers;

use app\models\Main;

use wfm\Controller;

use RedBeanPHP\R;

/** @property Main $model */
class MainController extends Controller
{
    public function indexAction()
    {
        $names = $this->model->get_names();
        $one_name = R::getRow( 'SELECT * FROM name WHERE id = 2');
        $this->setMeta('Main page', 'Description...', 'keywords...');
        $this->set(compact('names'));
    }
}






