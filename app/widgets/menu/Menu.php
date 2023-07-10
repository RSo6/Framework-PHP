<?php


namespace app\widgets\menu;


use RedBeanPHP\R;
use wfm\App;
use wfm\Cache;

class Menu
{

    // https://www.youtube.com/watch?v=fOMaYSmsiQU
    // https://www.youtube.com/watch?v=Qble3-723bs
    protected $data;
    protected $tree;
    protected $menu_html;
    protected $tpl;
    protected $container = 'ul';
    protected $class = 'menu';
    protected $cache = 3600;
    protected $cache_key = 'ishop_menu';
    protected $attrs = [];
    protected $prepend = '';
    protected $language;

    public function __construct($options = []){
        $this->language = App::$app->getProperty('language');
        $this->tpl = __DIR__ . '/menu_tpl.php';
        $this->getOptions($options);
        $this->run();
    }

    protected function getOptions($options){
        foreach($options as $k => $v){
            if(property_exists($this, $k)){
                $this->$k = $v;
            }
        }
    }

    protected function run(){
        $cache = Cache::getInstance();
        $this->menu_html = $cache->get("{$this->cache_key}_{$this->language['code']}");

        if(!$this->menu_html){
            /*$this->data = R::getAssoc("SELECT c.*, cd.* FROM category c
                        JOIN category_description cd
                        ON c.id = cd.category_id
                        WHERE cd.language_id = ?", [$this->language['id']]);*/
            $this->data = App::$app->getProperty("categories_{$this->language['code']}");
            $this->tree = $this->getTree();
            $this->menu_html = $this->getMenuHtml($this->tree);
            if($this->cache){
                $cache->set("{$this->cache_key}_{$this->language['code']}", $this->menu_html, $this->cache);
            }
        }

        $this->output();
    }

    protected function output(){
        $attrs = '';
        if(!empty($this->attrs)){
            foreach($this->attrs as $k => $v){
                $attrs .= " $k='$v' ";
            }
        }
        echo "<{$this->container} class='{$this->class}' $attrs>";
        echo $this->prepend;
        echo $this->menu_html;
        echo "</{$this->container}>";
    }

    protected function getTree(){
        $tree = [];
        $data = $this->data;
        foreach ($data as $id=>&$node) {
            if (!$node['parent_id']){
                $tree[$id] = &$node;
            } else {
                $data[$node['parent_id']]['children'][$id] = &$node;
            }
        }
        return $tree;
    }

    protected function getMenuHtml($tree, $tab = ''){
        $str = '';
        foreach($tree as $id => $category){
            $str .= $this->catToTemplate($category, $tab, $id);
        }

        return $str;
    }

    protected function catToTemplate($category, $tab, $id){
        ob_start();
        require $this->tpl;
        return ob_get_clean();
    }

}