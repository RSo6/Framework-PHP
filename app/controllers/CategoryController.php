<?php

namespace app\controllers;


use app\models\BreadCrumbs;
use app\models\Category;
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
//        debug($bread_crumbs);
        $ids = $this->model->getIds($category['id']);
        $ids = !$ids ? $category['id'] : $ids . $category['id'];
//        var_dump($ids);
//        var_dump(abs(get('page')));
        $page = abs(get('page')) ?: 1;
        $per_page = App::$app->getProperty('pagination');
        $total = $this->model->getCountProducts($ids);
//        var_dump($page, $per_page, $total);

        $pagination = new Pagination($page, $per_page, $total);
        $start = $pagination->getStart();
//        var_dump($start);


        $products = $this->model->getProducts($ids, $lang, $start, $per_page);
//        debug($products);
        $this->setMeta($category['title'], $category['description'], $category['keywords']);
        $this->set(compact('products', 'category', 'bread_crumbs', 'total', 'pagination'));
    }


}