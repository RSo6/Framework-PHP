<?php

namespace app\controllers;

use wfm\Controller;

class AppController extends Controller
{
    public function __construct($route) //викликаємо метод констуктора з класса Controller folder vendor\wfm;
    {
        parent::__construct($route);
    }

}