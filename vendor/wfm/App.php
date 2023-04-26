<?php

namespace wfm;

class App
{

    public static $app;

    public function __construct()
    {
        $query = trim(urldecode($_SERVER['QUERY_STRING']), '/');//берем поточний запит, трімимо кінцеві слеші і записуємо в перемінну $query
        session_start();
        new ErrorHandler();
        self::$app = Registry::getInstance();//:: розширює область видимості
        $this->getParams();
        Router::dispatch($query);//викликаємо метод dispatch і кладемо в нього перемінну $query
    }
    protected function getParams()
    {
        $params = require_once CONFIG . '/params.php';
        if (!empty($params)) {
            foreach ($params as $k => $v) {
                self::$app->setProperty($k, $v);
        }
     }
   }
}