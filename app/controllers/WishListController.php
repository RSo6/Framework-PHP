<?php

namespace app\controllers;

use app\models\WishList;
use wfm\App;

/**
 * @property WishList $model
 */
class WishListController extends AppController
{
    public function indexAction()
    {
        $lang = App::$app->getProperty('language');
        $products = $this->model->getWishListProductsByIds($lang);
//        debug($products,1);
        $this->setMeta(___('wishlist_index_title'));
        $this->set(compact('products'));
    }
    public function addAction()
    {
        $id = get('id');
        if (!$id) {
            $answer = [
                'result' => 'error',
                'text' => ___('tpl_wishlist_add_error')
                 ];
            exit(json_encode($answer));
        }

        $product = $this->model->getWishProducts($id);
        if ($product) {
            $this->model->addToWishList($id);
            $answer = [
                'result' => 'success',
                'text' => ___('tpl_wishlist_add_success')
            ];
        } else {
            $answer = [
                'result' => 'error',
                'text' => ___('tpl_wishlist_add_error')
            ];
        }
        exit(json_encode($answer));
    }

    public function deleteAction()
    {
        $id = get('id');

        if ($this->model->deleteFromWishList($id)) {
            $answer = [
                'result' => 'success',
                'text' => ___('tpl_wishlist_delete_success')
            ];
        } else {
            $answer = ['result' => 'error', 'text' => ___('tpl_wishlist_delete_error')];
        }
        exit(json_encode($answer));
    }


}