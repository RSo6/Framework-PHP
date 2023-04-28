<?php

namespace app\widgets\menu;

use RedBeanPHP\R;
use wfm\App;
use wfm\Cache;

class Menu
{
	
	
    protected $data;//в цій властивості зберігаються данні для віджета меню
    protected $tree;//дерево яке ми формуєм із дістаних данних
    protected $menu_html;//хтмл код нашого сформованого меню
    protected $tpl;//шаблон
    protected $container = 'ul';//в що буде обертатись наше меню, по замовчуванню тег ул
    protected $class = 'menu';//
    protected $cache = 3600;//кешування по замовчуванню на одну годину
    protected $cache_key = 'ModernShop_menu';//під цим ключем будуть кешуватися данні
    protected $attrs = [];//
    protected $prepend = '';//можливий код який можна додати перед нашим меню
    protected $language;//відповідає за мову

    public function __construct($options = [])
    {
        $this->language = App::$app->getProperty('language');//дістаєм активну мову з контейнера
        $this->tpl = __DIR__ . '/menu_tpl.php';//встановлюєм шлях до шаблону
        $this->getOptions($options);
        $this->run();
    }

    protected function getOptions($options)
    {//проходимовсь в циклі по опціях
        foreach ($options as $k => $v) { //в якості $k = Cache, а в якості $v = 0.
            if (property_exists($this, $k)) { //перевірка чи існує ключ в цьому класі
                $this->$k = $v;//тоді ми в цю властивість запишем опцію
            }
        }
    }

    protected function run()
    {
        $cache = Cache::getInstance();//створюєм обєкт кешу
        $this->menu_html = $cache->get("{$this->cache_key}_{$this->language['code']}");
        //зверху ми хочемо дістати дані по ключу і коду мову
        if (!$this->menu_html) {//якщо нема, тоді
//            $this->data = R::getAssoc( //в дата ми забираємо всі: категорії їх опис із урахуванням мови
//               "SELECT c.*, cd.* FROM category
//                c JOIN category_description cd
//                ON c.id = cd.category_id
//                WHERE cd.language_id = ?",
//                [$this->language['id']]
            $this->data = App::$app->getProperty("categories_{$this->language['code']}");
//            );//якщо ми забрали данні з кешу тоді переходимо в низ якщо ні то робимо перевірку
            $this->tree = $this->getTree();//з цього массиву ми формуємо дерево
            $this->menu_html = $this->getMenuHtml($this->tree);
            if ($this->cache) {//якщо в кеші більше нуля
                $cache->set("{$this->cache_key}_{$this->language['code']}",
                    //то ми кешуємо використовуючи метод сет(ми вказуємо ключ з додаванням префіксу(мови)
                $this->menu_html, $this->cache);//ми кладемо меню хтмл на вказаний час кеш
            }
        }
        $this->output();//викликаємо метод аутпут
    }

    protected function output()
    {//додаєм атрибути до нашого меню
        $attrs = '';
        if (!empty($this->attrs)) { //якщо атрібут не пустий тоді
            foreach ($this->attrs as $k => $v) { //проходимось по атрибутам
                $attrs .= " $k = '$v' ";// 'attrs' => ['id' => 'menu']
            }
        }
        //беремо контейнер(в нашому випадку тег <ul>) буде підставлений класс і рядок атрибуту
        echo "<{$this->container} class = '{$this->class}' $attrs>";
        echo $this->prepend;//тут може щось виводитись перед пунктом меню(адмінка)
        echo $this->menu_html;//виведемо саме меню
        echo "</{$this->container}>";//і замикаємо тег (</ul>)
    }

    protected function getTree()
    {
        $tree = [];//спочатку ініціалізуємо порожній массив
        $data = $this->data;//ставимо все що є в контейнері дата
        foreach ($data as $id => &$node) {//перебираємо всі данні по контерйнеру дата як ключ($id) i значення($node)
            if (!$node['parent_id']) {//якщо parent_id повертає false(0) значить це корнівий елемент тоді ми...
                $tree[$id] = &$node;//в наше дерево $id кладемо посилання на наш елемент,
                // &(якщо ми щось змінимо або покладемо дочірній елемент в елементі node - таким зразком ми змінимо і саме дерево )
            } else {//якщо parent_id поверне не нуль, тоді ми попадемо сюди
                $data[$node['parent_id']]['children'][$id] = &$node;//ми беремо в поточного елементу node[батьківський id]
                // і шукаємо в data(той ключ який попав в батьківський id)
                // в середині нього створюємо вкладений массив[діти] і по ключу id вкладуємо посилання на наш массив(елемент)
            }
        }
        return $tree;
    }

    protected function getMenuHtml($tree, $tab = '')
    {
        $str = '';
        foreach ($tree as $id => $category) {
            $str .= $this->catToTemplate($category,$tab,$id);
        }
        return $str;
    }

    protected function catToTemplate($category, $tab, $id)
    {
        ob_start();
        require $this->tpl;
        return ob_get_clean();
    }
}