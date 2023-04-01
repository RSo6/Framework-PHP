<?php

namespace wfm;

abstract class Model // we created abstract class Model;
{
    public array $attributes = [];// "$attributes" needed to auto filling the model with data;
    public array $errors = []; // here we put on possible errors;
    public array $rules = []; // array with rule validation;
    public array $labels = []; // indicates in the field which didn't pass validation;

    public function __construct()
    {
        Db::getInstance();
    }
}




















