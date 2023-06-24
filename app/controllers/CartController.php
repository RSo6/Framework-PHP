<?php

namespace app\controllers;


use app\models\Cart;
use app\models\Order;
use wfm\App;
use app\models\User;
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

     public function viewAction()
     {
//         debug($_SESSION['user']);
         $this->setMeta(___('tpl_cart_title'));
     }

     public function checkoutAction()
     {
         if (!empty($_POST)) {
            //реєстрація користувача, якщо він не авторизований
             if (!(User::checkAuth())) {
               $user = new User();
               $user->load();
               if (!$user->validate($user->attributes) || !$user->checkUnique()) {
                    $user->getErrors();
                    $_SESSION['form_data'] = $user->attributes;
                    redirect();
               } else {
                   $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);
                        if (!$user_id = $user->save('user')) {
                            $_SESSION['errors'] = ___('cart_checkout_error_register');
                            redirect();
                        }
                     }
                  }
             //збереження замовлення
             $data['user_id'] = $user_id ?? $_SESSION['user']['id'];
             $data['note'] = post('note');
             $user_email = $_SESSION['user']['email'] ?? post('email');

                if (!$order_id = Order::saveOrder($data)) {
                    $_SESSION['errors'] = ___('cart_checkout_error_save_order');
                } else {
                    Order::mailOrder($order_id, $user_email, 'mail_order_user');
                    Order::mailOrder($order_id, App::$app->getProperty('admin_email'), 'mail_order_user');
                    unset($_SESSION['cart']);
                    unset($_SESSION['sum']);
                    unset($_SESSION['qty']);
                    $_SESSION['success'] = ___('cart_checkout_order_success');
                }
         }
         redirect();
     }


}