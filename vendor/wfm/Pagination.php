<?php


namespace wfm;

class Pagination
{

    public $current_page;// номер поточної сторінки
    public $per_page;//к-сть товарів на одній сторінці
    public $total;//всього товару
    public $count_pages;//к-сть сторінок
    public $uri;//параметри запиту


    public function __construct($page, $per_page, $total)//арг 1 -
    {
        $this->per_page = $per_page;
        $this->total = $total;
        $this->count_pages = $this->getCountPages();
        $this->current_page = $this->getCurrentPage($page);
        $this->uri = $this->getParams();

    }

    public function getHtml()
    {
        $back = null; // посилання  НАЗАД
        $forward = null; // посилання ВПЕРЕД
        $start_page = null; // посилання В ПОЧАТОК
        $end_page = null; // посилання В КІНЕЦЬ
        $page_2_left = null; // друга сторінка зліва
        $page_1_left = null; // перша сторінка зліва
        $page_2_right = null; // друга сторінка по право
        $page_1_right = null; // перша сторінка по право

        // $back
        if ($this->current_page > 1) { //якщо теперішня сторінка більша ніж 1 тоді ми показуємо посилання
            $back = "<li class='page-item'><a class='page-link' href='" . $this->getLink($this->current_page - 1) . "'>&lt;</a></li>";
        }  // &lt-це html знак менше(<)

        // $forward
        if ($this->current_page < $this->count_pages) { //беремо поточну сторінку і якщо вона менше загал. к-сті ст. то вставляємо посил вперед
            $forward = "<li class='page-item'><a class='page-link' href='" . $this->getLink($this->current_page + 1) . "'>&gt;</a></li>";
        }// &gt-це html знак більше(>)

        // $start-page - посилання з якого ми починаємо
        if ($this->current_page > 3) {//посил на стартову сторінку якщо вона більше ніж 3
            $start_page = "<li class='page-item'><a class='page-link' href='" . $this->getLink(1) . "'>&laquo;</a></li>";
        }// &laquo; -це html знак "«" перехода

        // $end_page - посилання на останню сторінку
        if ($this->current_page < ($this->count_pages - 2)) {
            $end_page = "<li class='page-item'><a class='page-link' href='" . $this->getLink($this->count_pages) . "'>&raquo;</a></li>";
        }// &raquo;-це html  знак "»" перехода

        // $page_2_left
        if ($this->current_page - 2 > 0) {
            $page2left = "<li class='page-item'><a class='page-link' href='" . $this->getLink($this->current_page - 2) . "'>" . ($this->current_page - 2) . "</a></li>";
        }

        // $page_1_left
        if ($this->current_page - 1 > 0) {
            $page1left = "<li class='page-item'><a class='page-link' href='" . $this->getLink($this->current_page - 1) . "'>" . ($this->current_page - 1) . "</a></li>";
        }

        // $page_1_right
        if ($this->current_page + 1 <= $this->count_pages) {
            $page1right = "<li class='page-item'><a class='page-link' href='" . $this->getLink($this->current_page + 1) . "'>" . ($this->current_page + 1) . "</a></li>";
        }

        // $page_2_right
        if ($this->current_page + 2 <= $this->count_pages) {
            $page2right = "<li class='page-item'><a class='page-link' href='" . $this->getLink($this->current_page + 2) . "'>" . ($this->current_page + 2) . "</a></li>";
        }

        return '<nav aria-label="Page navigation example"><ul class="pagination">'
            . $start_page . $back . $page_2_left . $page_1_left . '<li class="page-item active"><a class="page-link">' .
            $this->current_page . '</a></li>' . $page_1_right . $page_2_right . $forward . $end_page . '</ul></nav>';
    }

    public function getLink($page)
    {
        if ($page == 1) {
            return rtrim($this->uri, '?&');
        }

        if (str_contains($this->uri, '&')) {
            return "{$this->uri}page={$page}";
        } else {
            if (str_contains($this->uri, '?')) {
                return "{$this->uri}page={$page}";
            } else {
                return "{$this->uri}?page={$page}";
            }
        }
    }

    public function __toString()//магічний метод, він преобразовує об'єкт класу в рядок
    {
        return $this->getHtml();
    }

    public function getCountPages()// к-сть сторінок
    {// ceil - повертає значення яке округлене в більшу сторону
        return ceil($this->total / $this->per_page) ?: 1;// ділимо к-сть всього товару на к-сть товару на одну сторінку
    }

    public function getCurrentPage($page)// в аргументін номер поточної сторінки(та на якій ми знаходимось)
    {
        if (!$page || $page < 1) $page = 1; // якшо немає сторінки(!$page) або (||) сторінка менше 1, тоді ми присвоюємо в $page = 1
        if ($page > $this->count_pages) $page = $this->count_pages; // якщо номер ст. більше > к-сті ст. тоді ми присвоюємо загальну к-сть ст.
        return $page;

    }

    public function getStart()//вказує з якого продукту потрібно почати вибірку товарів
    {
        return ($this->current_page - 1) * $this->per_page;// від поточної сторінки відняти 1 і помножити на к-сть товарів на сторінці

    }

    public function getParams()//getter який забирає get параметри
    {   //$_SERVER['REQUEST_URI'] - буде зберігати повний шлях запиту, включаючи рядок запиту
        $url = $_SERVER['REQUEST_URI']; // http://git.myroslav/category/kompyutery/page=1&sort=name
        // розбиваємо шлях запиту знаком питанням http://git.myroslav/category/kompyutery"-ось наш знак розділу ?-"page=1&sort=name
        $url = explode('?', $url);
        $uri = $url[0];// в url під ключем 0 буде стояти http://new-myshop.loc/category/kompyutery тобто до сепараторя "?"
        if (isset($url[1]) && $url[1] != '') {//якщо існує url[1] тобто page=1&sort=name і (&&) якщо url[1] не пустий тоді...
            $uri .= '?';          //формуємо рядки запиту і прибавляєм знак ?
            $params = explode('&', $url[1]);//розбиваємо url[1] по амперсанту
            foreach ($params as $param) {//якщо не є regexp(!preg_match) шукамий параметр("#page=#") у вхідному рядку ($param) тоді...
                if (!preg_match("#page=#", $param)) $uri .= "{$param}&";
            }
        }
        return $uri;
    }





}