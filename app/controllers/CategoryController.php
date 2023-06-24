<?php

namespace app\controllers;


use app\models\BreadCrumbs;
use app\models\Category;
use app\models\User;
use wfm\App;
use wfm\Pagination;

/**
 * @property Category $model
 */

class CategoryController extends AppController
{ //в контроллері ми дістаємо данні про категорії і данні про товар які відносятся до цієї категорії

    public function viewAction()
    {
        $lang = App::$app->getProperty('language');// дістаємо мову
        $category = $this->model->getCategory($this->route['slug'], $lang);
//        debug($category,1);

        if (!$category) {
            $this->error404();
            return;
        }
        $bread_crumbs = BreadCrumbs::getBreadCrumbs($category['id']);

        $ids = $this->model->getIds($category['id']);
        $ids = !$ids ? $category['id'] : $ids . $category['id'];

        $page = get('page');
//        debug($page);
        $pagination_per_page = get('pagination');;
        $basic = App::$app->getProperty('pagination');
//        debug($basic);
         $per_page = in_array($pagination_per_page, [5,10,15,25]) ? $pagination_per_page : $basic;
//         debug($per_page);
        $total = $this->model->getCountProducts($ids);
//            debug($total);
        $pagination = new Pagination($page, $per_page, $total);
//        debug($pagination);
        $start = $pagination->getStart();
//        debug($start);

        $products = $this->model->getProducts($ids, $lang, $start, $per_page);
//        debug($products);
        $this->setMeta($category['title'], $category['description'], $category['keywords']);
        $this->set(compact('products', 'category', 'bread_crumbs', 'total', 'pagination'));
    }



}