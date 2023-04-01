<?php

namespace app\models;

use RedBeanPHP\R;

class Main extends \wfm\Model  //legacy of the base model
{
    public function get_names(): array
    {
        return R::findAll('name');
    }
}