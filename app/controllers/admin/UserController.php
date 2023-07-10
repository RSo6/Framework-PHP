<?php

namespace app\controllers\admin;

use  app\models\admin\User;


/** @property User $model */
class UserController extends AppController

{
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