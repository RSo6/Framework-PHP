<?php


namespace app\controllers;


use app\models\BreadCrumbs;
use app\models\Product;
use app\models\User;
use wfm\App;

/** @property Product $model*/

class ProductController extends AppController
{


    public function viewAction()
    {
        $lang = App::$app->getProperty('language');
//        debug($lang,1);
        $product = $this->model->getProduct($this->route['slug'], $lang);
//        debug($product, 1);

        if (!$product) {
//            throw new \Exception("Продукт по запиту {$this->route['slug']} не знайдено", 404);
            $this->error404();
            return;
        }
//        debug($product);

        $bread_crumbs = BreadCrumbs::getBreadCrumbs($product['category_id'], $product['title']);
//        debug($bread_crumbs);
        $gallery = $this->model->getGallery($product['id']);
//        debug($gallery);
        $this->setMeta($product['title'], $product['description'], $product['keywords']);
        $this->set(compact('product', 'gallery', 'bread_crumbs'));
        // array { приклад функції компакт
        //[product] => 'gallery'
        //       }

    }

}






