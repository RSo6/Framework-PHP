<?php

namespace app\controllers\admin;

use RedBeanPHP\R;

class MainController extends AppController
{
    public function indexAction()
    {
        $orders = R::count('orders');
        $new_orders = R::count('orders', 'status = 0');
        $users = R::count('user');
        $products = R::count('product');
//        debug($products);
//        debug($users);
//        debug($new_orders,1);
//        debug($orders,1);
        $title = 'Головна Сторінка';
        $this->setMeta('Адмінка :: Головна Сторінка');
        $this->set(compact('title', 'orders', 'new_orders', 'users', 'products'));
    }



}