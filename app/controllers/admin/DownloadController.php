<?php


namespace app\controllers\admin;


use app\models\admin\Download;
use RedBeanPHP\R;
use wfm\App;
use wfm\Pagination;

/** @property Download $model */
class DownloadController extends AppController
{

    public function indexAction()
    {
        $lang = App::$app->getProperty('language');
        $page = get('page');
        $per_page = 20;
        $total = R::count('download');
        $pagination = new Pagination($page, $per_page, $total);
        $start = $pagination->getStart();

        $downloads = $this->model->getDownloads($lang, $start, $per_page);
        $title = 'Файлы (цифровые товары)';
        $this->setMeta("Админка :: {$title}");
        $this->set(compact('title', 'downloads', 'pagination', 'total'));
    }

    public function addAction()
    {
        if (!empty($_POST)) {
           if ($this->model->downloadValidate()) {
               if ($data = $this->model->uploadFile()) {
//                   debug($data,1);
                    if ($this->model->saveDownload($data)) {
                        $_SESSION['success'] = 'Файл був успішно доданий';
                    } else {
                        $_SESSION['errors'] = 'Помилка додавання файла';
                    }

               } else {
                   $_SESSION['errors'] = 'Помилка переміщення файла';
               }

           }
           redirect();
        }
        $title = 'Додавання файлу (цифрового товару)';
        $this->setMeta("Админка :: {$title}");
        $this->set(compact('title'));
    }

    public function deleteAction()
    {
        $id = get('id');
        if (R::count('order_download', 'download_id = ?', [$id])) {
                $_SESSION['errors'] = 'не можливо видалити, цей файл був куплений';
                redirect();
        }
        if (R::count('product_download', 'download_id = ?', [$id])) {
                $_SESSION['errors'] = 'Не можливо видалити, цей файл був прикріплений до товару';
                redirect();
        }
        if ($this->model->downloadDelete($id)) {
            $_SESSION['success'] = "Файл видалений";
        } else {
            $_SESSION['errors'] = 'Помилка видалення файлу';
        }
        redirect();
    }
}













