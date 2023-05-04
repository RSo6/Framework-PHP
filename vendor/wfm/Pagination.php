<?php


namespace wfm;

class Pagination
{

    public $current_page;
    public $per_page;
    public $total;//всього
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
        $start_page = null; // посилання В НАЧАЛО
        $end_page = null; // посилання В КОНЕЦ
        $page_2_left = null; // вторая страница слева
        $page_1_left = null; // первая страница слева
        $page_2_right = null; // вторая страница справа
        $page_1_right = null; // первая страница справа

        // $back
        if ($this->current_page > 1) { //якщо теперішня сторінка більша ніж перша тоді ми показуємо посил
            $back = "<li class='page-item'><a class='page-link' href='" . $this->getLink($this->current_page - 1) . "'>&lt;</a></li>";
        }

        // $forward
        if ($this->current_page < $this->count_pages) { //беремо поточну сторінку і якщо вона менше загал. к-сті ст. то вставляємо посил вперед
            $forward = "<li class='page-item'><a class='page-link' href='" . $this->getLink($this->current_page + 1) . "'>&gt;</a></li>";
        }

        // $start-page
        if ($this->current_page > 3) {//посил на стартову
            $start_page = "<li class='page-item'><a class='page-link' href='" . $this->getLink(1) . "'>&laquo;</a></li>";
        }

        // $end_page
        if ($this->current_page < ($this->count_pages - 2)) {
            $end_page = "<li class='page-item'><a class='page-link' href='" . $this->getLink($this->count_pages) . "'>&raquo;</a></li>";
        }

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

    public function __toString()
    {
        return $this->getHtml();
    }

    public function getCountPages()
    {
        return ceil($this->total / $this->per_page) ?: 1;
    }

    public function getCurrentPage($page)//номер сторінки в аргументі
    {
        if (!$page || $page < 1) $page = 1;
        if ($page > $this->count_pages) $page = $this->count_pages;
        return $page;

    }

    public function getStart()//вказує з якого продукту потрібно почати вибірку товарів
    {
        return ($this->current_page - 1) * $this->per_page;

    }

    public function getParams()
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('?', $url);
        $uri = $url[0];
        if (isset($url[1]) && $url[1] != '') {
            $uri .= '?';          //формуємо рядки запиту
            $params = explode('&', $url[1]);
            foreach ($params as $param) {
                if (!preg_match("#page=#", $param)) $uri .= "{$param}&";
            }
        }
        return $uri;
    }





}