<?php

namespace app\controllers;


use app\models\Cart;
use wfm\App;

/**
 * @property Cart $model
 */
class CartController extends AppController
{
    public function addAction(): bool
    {
        $lang = App::$app->getProperty('language');//беремо мову із контейнера
        $id = get('id');//дістань айді товару
        $qty = get('qty');//дістань кількість
        var_dump($id, $qty);

        if (!$id) {//якщо в id щось що ниє числом
            return false;//повертаємо похибку
        }

        $product = $this->model->getProduct($id, $lang);
//        debug($product, 1);
        if (!$product) {
            return false;
        }

        $this->model->addToCart($product, $qty);

        if ($this->isAjax()) {
            $this->loadView('cart_modal');
//            debug($_SESSION['cart'],1);
        }
        redirect();
        return true;
     }

     public function showAction()
     {
         $this->loadView('cart_modal');
     }

     public function deleteAction()
     {
         $id = get('id');
         if (isset($_SESSION['cart'][$id])) {

         }
         if ($this->isAjax()) {
             $this->loadView('cart_modal');
         }
         redirect();
     }

     public function clearAction()
     {
         if (empty($_SESSION['cart'])) {
             return false;
         }
         unset($_SESSION['cart']);
         unset($_SESSION['cart.qty']);
         unset($_SESSION['cart.sum']);
         $this->loadView('cart_modal');
         return true;
     }

}