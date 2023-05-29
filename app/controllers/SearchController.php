<?php

namespace app\controllers;

use App\models\Search;
use wfm\App;
use wfm\Pagination;

/**
 * @property Search $model
 */

class SearchController extends AppController
{
    public function indexAction()
    {
        $s = get('s', 's');
        $lang = App::$app->getProperty('language');
        $page = get('page');
        $per_page = App::$app->getProperty('pagination');
        $total = $this->model->getCountFindProducts($s, $lang);
        $pagination = new Pagination($page, $per_page, $total);
        $start = $pagination->getStart();

        $products = $this->model->getFindProducts($s, $lang, $start, $per_page);
//        debug($products, 1);
        $this->setMeta(___('tpl_search_title'));
        $this->set(compact('s', 'products', 'pagination' , 'total'));


    }


}