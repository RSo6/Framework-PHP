<?php


namespace app\controllers\admin;

use app\models\admin\Order;
use mysql_xdevapi\Exception;
use RedBeanPHP\R;
use wfm\Pagination;

/** @property Order $model */
class OrderController extends AppController
{

    public function indexAction()
    {
        $status = get('status', 's');
        $status = ($status == 'new') ? ' status = 0 ' : '';

        $page = get('page');
        $per_page = 20;
        $total = R::count('orders', $status);
        $pagination = new Pagination($page, $per_page, $total);
        $start = $pagination->getStart();

        $orders = $this->model->getOrders($start, $per_page, $status);
//        debug($orders);
        $title = 'Orders list';
        $this->setMeta("Admin :: {$title}");
        $this->set(compact('title', 'orders', 'pagination', 'total'));
    }

    public function editAction()
    {
        $id = get('id');

        if (isset($_GET['status'])) {
            $status = get('status');
            if ($this->model->changeStatus($id, $status)) {
                $_SESSION['success'] = 'Order status was changed';
            } else {
                $_SESSION['errors'] = 'Status change ERROR!';
            }
        }
        $order = $this->model->getOrder($id);
        if (!$order) {
            throw new Exception('Not found order', 404);
        }
        $title = "Orders № {$id}";
        $this->setMeta("Admin :: {$title}");
        $this->set(compact('title', 'order'));
    }
}