<?php

namespace wfm;

use RedBeanPHP\R;
use Valitron\Validator;

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

    public function load($post = true)
    {
        $data = $post ? $_POST : $_GET;
        foreach($this->attributes as $name => $value) {
            if (isset($data[$name])) {
                $this->attributes[$name] = $data[$name];
            }
        }
    }

    public function validate($data): bool
    {
        Validator::langDir(APP . '/languages/validator/lang');
//        $lang = App::$app->getProperty('language');
//        if ($lang['id'] === '1') {
//            Validator::lang('ua');
//        }                                       -----personal method-----
//        if ($lang['id'] == '0') {
//            Validator::lang('en');
        Validator::lang(App::$app->getProperty('language')['code']);    // -----author method more intelligent-----

        $validator = new Validator($data);
        $validator->rules($this->rules);
        $validator->labels($this->getLabels());
        if ($validator->validate()) {
            return true;
        } else {
            $this->errors = $validator->errors();
            debug($this->errors);
            return false;
        }

    }

    public function getErrors()
    {
        $errors = '<ul>';
        foreach ($this->errors as $error) {
            foreach ($error as $item) {
                $errors .= "<li>{$item}</li>>";
            }
        }
        $errors .= '</ul>';
        $_SESSION['errors'] = $errors;
    }

    public function getLabels(): array
    {
        $labels = [

        ];
        foreach ($this->labels as $k => $v) {
            $labels[$k] = ___($v);
        }
        return $labels;
    }

    public function save($table): int|string
    {
        $tbl = R::dispense($table);//створюємо об'єкт
        foreach ($this->attributes as $name => $value) {
            if ($value != '') {
                $tbl->$name = $value;
            }
        }
        return R::store($tbl);//зберігаємо об'єкт
    }

    public function update($table, $id): int|string
    {
        $tbl = R::load($table, $id);
        foreach ($this->attributes as $name => $value) {
            if ($value !== '') {
                $tbl->$name = $value;
            }
        }
        return R::store($tbl);
    }

}




















