<?php


namespace app\widgets\page;


use RedBeanPHP\R;
use wfm\App;
use wfm\Cache;

class Page
{

    protected $language;
    protected string $container = 'ul';
    protected string $class = 'page-menu';
    protected int $cache = 3600;
    protected string $cache_key = 'myshop_page_menu';
    protected string $menu_page_html;
    protected string $prepend = '';//данні перед меню
    protected $data;//данні які дістаються з бд

    public function __construct($options = [])
    {
        $this->language = App::$app->getProperty('language');//отримуємо активну мову
        $this->getOptions($options);//викликаємо метод який сбере опції передаванні при створенні екземпляра класу
        $this->run();
    }

    protected function getOptions($options)
    {
        foreach ($options as $k => $v) {
            if (property_exists($this, $k)) {
                $this->$k = $v;
            }
        }
    }

    protected function run()
    {
        $cache = Cache::getInstance();//створюємо об'єкт класу кеш
        $this->menu_page_html = $cache->get("{$this->cache_key}_{$this->language['code']}");//забираємо по ключу данні із кешу

        if (!$this->menu_page_html) { //якщо данних немає, тоді дістаємо їх із бази данних
            $this->data = R::getAssoc("SELECT p.*, pd.* FROM page p 
                        JOIN page_description pd
                        ON p.id = pd.page_id
                        WHERE pd.language_id = ?", [$this->language['id']]);
            $this->menu_page_html = $this->getMenuPageHtml();
            if ($this->cache) {//якщо кешування увімкнено
                $cache->set("{$this->cache_key}_{$this->language['code']}", $this->v, $this->cache);//тоді ми кладемо сформоване меню в кеш
            }
        }

        $this->output();
    }

    protected function getMenuPageHtml()
    {
        $html = '';
        foreach ($this->data as $k => $v) {
            $html .= "<li><a href='page/{$v['slug']}'>{$v['title']}</a></li>";
        }
        return $html;
    }

    protected function output()
    {
        echo "<{$this->container} class='{$this->class}'>";//обертає данні в контейнер
        echo $this->prepend;//данні перед меню
        echo $this->menu_page_html;//данні
        echo "</{$this->container}>";//замикаємо контейнер
    }

}