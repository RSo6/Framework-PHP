<?php

namespace app\controllers\admin;

use  app\models\admin\User;
use RedBeanPHP\R;
use wfm\Pagination;


/** @property User $model */
class UserController extends AppController

{
    public function  indexAction()
    {
        $page = get('page');
        $per_page = 20;
        $total = R::count('user');
        $pagination = new Pagination($page, $per_page, $total);
        $start = $pagination->getStart();

        $users = $this->model->getUsers($start, $per_page);

        $title = 'Users list';
        $this->setMeta("Admin :: {$title}");
        $this->set(compact('title', 'users', 'pagination', 'total'));
    }


    public function viewAction()
    {
        $id = get('id');
        $user = $this->model->getUser($id);
        if (!$user) {
            throw new \Exception('Not found user', 404);
        }

        $page = get('page');
        $per_page = 1;
        $total = $this->model->getCountOrders($id);
        $pagination = new Pagination($page, $per_page, $total);
        $start =$pagination->getStart();

        $orders = $this->model->getUserOrders($start, $per_page, $id);
        $title = 'User profile';
        $this->setMeta("Admin :: {$title}");
        $this->set(compact('title', 'user', 'pagination', 'total', 'orders'));
    }

    public function editAction()
    {
        $id = get('id');
        $user = $this->model->getUser($id);
        if (!$user) {
            throw new \Exception('Not found user', 404);
        }

        if (!empty($_POST)) {
           $this->model->load();
            if (empty($this->model->attributes['password'])) {
                unset($this->model->attributes['password']);
            }
            if (!$this->model->validate($this->model->attributes) || !$this->model->checkEmail($user)) {
                $this->model->getErrors();
            } else {
                if (!empty($this->model->attributes['password'])) {
                    $this->model->attributes['password'] = password_hash($this->model->attributes['password'], PASSWORD_DEFAULT);
                }
                if ($this->model->update('user', $id)) {
                    $_SESSION['success'] = 'Data of user updated.-Relogin if you updated self data';
                } else {
                    $_SESSION['errors'] = 'User profile updated error!';
                }
            }
//            debug($this->model->attributes,1);
            redirect();
        }
        $title = 'Edit user';
        $this->setMeta("Admin :: {$title}");
        $this->set(compact('title', 'user'));
    }

    public function addAction()
    {
        if (!empty($_POST)) {
            $this->model->load();
            if (!$this->model->validate($this->model->attributes) || !$this->model->checkUnique(
              'This email already used')) {
               $this->model->getErrors();
               $_SESSION['form-data'] = $_POST;
            } else {
             $this->model->attributes['password'] = password_hash($this->model->attributes['password'], PASSWORD_DEFAULT);
                if ($this->model->save('user')) {
                    $_SESSION['success'] = 'User added';
                } else {
                    $_SESSION['errors'] = 'User add error!  ';
                }
            }
            redirect();
        }

        $title = 'New user';
        $this->setMeta("Admin :: {$title}");
        $this->set(compact('title'));

    }
    public function loginAdminAction()
    {
        if ($this->model->isAdmin()) {//якщо користувач авторизований як адмін
            redirect(ADMIN);// то перекидуємо його на адмінку
        }


        $this->layout = 'login';//адмінка
        if (!empty($_POST)) {//Якщо данні із форми не пусті
            if ($this->model->login(true)) {//авторизуємо адміна
                $_SESSION['success'] = 'Authorization was successfully';
            } else {//інакше помилка
                $_SESSION['errors'] = 'login or password is incorrect';
            }
            if ($this->model->isAdmin()) {//перевірка чи role - admin
                redirect(ADMIN);//і редірект на адмінку

            } else { //інакше редірект на сторінку авторизації
                redirect();
            }
        }

    }

    public function logoutAction()
    {
        if ($this->model->isAdmin()) {
            unset($_SESSION['user']);
        }
        redirect(ADMIN . '/user/login-admin');
    }


}