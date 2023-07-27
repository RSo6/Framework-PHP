<?php

namespace app\controllers\admin;

use app\models\admin\Product;
use wfm\App;
use RedBeanPHP\R;
use wfm\Pagination;


/**
 * @property Product $model
 */
class ProductController extends AppController
{

    public function indexAction()
    {
        $lang = APP::$app->getProperty('language');
        $page = get('page');
        $per_page = 3;
        $total = R::count('product');
        $pagination = new Pagination($page, $per_page, $total);
        $start = $pagination->getStart();

        $products = $this->model->getProducts($lang, $start, $per_page);
        $title = 'Список товарів';
        $this->setMeta("Admin :: {$title}");
        $this->set(compact('title', 'products', 'pagination', 'total'));

    }

    public function addAction()
    {
        if (!empty($_POST)) {

        }

        $title = "New Product";
        $this->setMeta("Admin :: {$title}");
        $this->set(compact('title'));
    }

    public function getDownloadAction()
    {
        $data = [
            'items' => [
            [
                'id' => 1,
                'text' => 'Файл 1',
            ],
            [
                'id' => 2,
                'text' => 'Файл 2',
            ],
            [
                'id' => 3,
                'text' => 'File 1',
            ],
            [
                'id' => 4,
                'text' => 'File 2',
            ]
            ]
        ];
        echo json_encode($data);
        die;
    }
}









































