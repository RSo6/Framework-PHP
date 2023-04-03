<?php

namespace wfm;

use RedBeanPHP\R;

class View
{
    public string $content = '';

    public function __construct(
        public $route,
        public $layout = '',
        public $view = '',
        public $meta = [],
    )
    {
        if (false !== $this->layout) {
            $this->layout = $this->layout ?: LAYOUT;
        }
    }

    public function render($data)
    {
        if (is_array($data)) {
            extract($data);
        }
        // admin\ => admin/
        $prefix = str_replace('\\', '/', $this->route['admin_prefix']);
        $view_file = APP . "/views/{$prefix}{$this->route['controller']}/{$this->view}.php";

        if (is_file($view_file)) {
            ob_start();
            require_once $view_file;
            $this->content = ob_get_clean();
        } else {
            throw new \Exception("Не знайдено вид {$view_file}", 500);
        }

        if (false !== $this->layout) {
            $layout_file = APP . "/views/layouts/{$this->layout}.php";
            if (is_file($layout_file)) {
                require_once $layout_file;
            } else {
                throw new \Exception("Не знайдено шаблон {$layout_file}", 500);
            }
        }
    }
    public function getMeta()
    {
        $out = '<title>' . h($this->meta['title']) . '</title>' . PHP_EOL;
        $out .= '<meta name="description" content="' . h($this->meta['description']) . '">' . PHP_EOL;
        $out .= '<meta name="keywords" content="' . h($this->meta['keywords']) . '">' . PHP_EOL;
        return $out;
    }

    public function getDbLogs()//цей метод дістає логи з бази данних;
    {
        if (DEBUG) {//якщо дебаг дорівнює 1 тобто тру то викон. наступні дії;
            $logs = R::getDatabaseAdapter()
                ->getDatabase()
                ->getLogger();
            $logs = array_merge(//функція array_merge - зливає массиви в одне ціле;
                $logs->grep('SELECT'),
                $logs->grep('select'),
                $logs->grep('INSERT'),
                $logs->grep('UPDATE'),
                $logs->grep('DELETE')
            );
            debug($logs);
        }

    }

    public function getPart($file,$data = null)//дістає певну частину шаблона
    {
        if (is_array($data)) {
            //дістаємо, після чого ці данні стануть доступні у підкл. шаблоні
            extract($data);
        }
            //Формуємо шлях до нашого підкл. шаблону.
        $file = APP . "/views/{$file}.php";
        if (is_file($file)) { //якщо він є
            require $file;    //тоді тут ми підкл його
        } else {               //в іншому випадку
            echo "File {$file} not found...";//виведе файл не знайдено
        }

    }
}