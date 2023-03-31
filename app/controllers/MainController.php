<?php

namespace app\controllers;

use wfm\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        $names = ['Myroslav', 'Roman', 'Vasily'];
        $this->setMeta(
            'Main Page',
            'description...',
            'keywords...'
        );
//        $this->set(['test' => 'Test VAR', 'name' => 'John']);
//        $this->set(['names'=>$names]);
        $this->set(compact('names'));
    }
}






