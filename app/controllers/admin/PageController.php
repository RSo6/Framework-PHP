<?php

namespace app\controllers\admin;

use app\models\admin\Page;
use League\Flysystem\Exception;
use wfm\App;
use RedBeanPHP\R;
use wfm\Pagination;


/**
 * @property Page $model
 */
class PageController extends AppController
{
    public function indexAction()
    {
        $lang = App::$app->getProperty('language');
        $page = get('page');
        $per_page =     20;
        $total = R::count('page');
        $pagination = new Pagination($page, $per_page, $total);
        $start = $pagination->getStart();

        $pages = $this->model->getPages($lang, $start, $per_page);

        $title = 'List of pages';
        $this->setMeta("Admin :: {$title}");
        $this->set(compact('title', 'pages', 'pagination', 'total'));

    }

    public function deleteAction()
    {
        $id = get('id');
        if ($this->model->deletePage($id)) {
            $_SESSION['success'] = 'Page deleted';
        } else {
            $_SESSION['errors'] = 'Page delete error';
        }
        redirect();
    }

    public function addAction()
    {
        if (!empty($_POST)) {
            if ($this->model->pageValidate()) {
                if ($this->model->savePage()) {
                    $_SESSION['success'] = 'Page added';
            } else {
                $_SESSION['errors'] = 'Page added error';
            }
        }
            redirect();
        }

        $title = 'New page';
        $this->setMeta("Admin :: {$title}");
        $this->set(compact('title'));

    }

    public function editAction()
    {
        $id = get('id');
        if (!empty($_POST)) {
            if ($this->model->pageValidate()) {
                if ($this->model->updatePage($id)) {
                    $_SESSION['success'] = 'Page saved success';
                } else {
                    $_SESSION['errors'] = 'Page updated error';
                }
            }
            redirect();
        }

        $page = $this->model->getPage($id);
        if (!$page) {
            throw new \Exception('Not found page', 404);
        }


        $title = 'Edit Page';
        $this->setMeta("Admin :: {$title}");
        $this->set(compact('title', 'page'));
    }

}












