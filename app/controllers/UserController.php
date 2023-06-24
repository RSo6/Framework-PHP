<?php

namespace app\controllers;

use app\models\User;
use wfm\App;
use wfm\Pagination;
/**
 * @property User $model
 */
class UserController extends AppController
{

    public function credentialsAction()
    {
        if (!User::checkAuth()) {
            redirect(baseUrl() . 'user/login');
        }

        if (!empty($_POST)) {
            $this->model->load();

            if (empty($this->model->attributes['password'])) {
                unset($this->model->attributes['password']);
            }
            unset($this->model->attributes['email']);


            if (!$this->model->validate($this->model->attributes)) {
                $this->model->getErrors();
            } else {
                if (!empty($this->model->attributes['password'])) {
                    $this->model->attributes['password'] = password_hash($this->model->attributes['password'], PASSWORD_DEFAULT);
                }

                if ($this->model->update('user', $_SESSION['user']['id'])) {
                    $_SESSION['success'] = ___('user_credentials_success');
                    foreach ($this->model->attributes as $k => $v) {
                        if (!empty($v) && $k != 'password') {
                            $_SESSION['user'][$k] = $v;
                        }
                    }
                } else {
                    $_SESSION['errors'] = ___('user_credentials_error');
                }
            }
            redirect();
        }

        $this->setMeta(___('user_credentials_title'));
    }
    public function signUpAction()
    {
        if (User::checkAuth()) {
            redirect(baseUrl());
        }

        if (!empty($_POST)) {
            $data = $_POST;
//            debug($data, 1);
            $this->model->load($data);
            if (!$this->model->validate($data) || !$this->model->checkUnique()) {
                $this->model->getErrors();
                $_SESSION['form_data'] = $data;
            }
            else {
                $this->model->attributes['password'] = password_hash($this->model->attributes['password'], PASSWORD_DEFAULT);
                if ($this->model->save('user')) {
                    $_SESSION['success'] = ___('user_signup_success_register');
                } else {
                    $_SESSION['errors'] = ___('user_signup_error_register');
                }

            }
                redirect();

        }
        $this->setMeta(___('tpl_signup'));
    }

    public function loginAction()
    {
        if (User::checkAuth()) {
            redirect(baseUrl());
        }
        if (!empty($_POST)) {
            if ($this->model->login()) {
                $_SESSION['success'] = ___('user_login_success_login');
                redirect(baseUrl());
            } else {
                $_SESSION['errors'] = ___('user_login_error_login');
                redirect();
            }
        }
        $this->setMeta(___('tpl_login'));

    }
    public function logoutAction()
    {
        if (User::checkAuth()) {
           unset($_SESSION['user']);
        }
        redirect(baseUrl() . 'user/login');

    }
    public function cabinetAction()
    {
        if (!User::checkAuth()) {
            redirect(baseUrl() . 'user/login');
        }
        $this->setMeta(___('tpl_cabinet'));
    }

    public function ordersAction()
    {
        if (!User::checkAuth()) {
            redirect(baseUrl() . "user/login" );
        }
        $page = get('page');
//        debug($page, 1);
        $per_page = App::$app->getProperty('pagination');
//        $per_page = 1;
//        debug($per_page, 1);
        $total = $this->model->getCountOrders($_SESSION['user']['id']);
        $pagination = new Pagination($page, $per_page, $total);
        $start = $pagination->getStart();

        $orders = $this->model->getUserOrders($start, $per_page, $_SESSION['user']['id']);
        $this->setMeta(___('user_orders_title'));
        $this->set(compact('orders', 'pagination', 'total'));

    }

    public function orderAction()
    {
        if (!User::checkAuth()) {
            redirect(baseUrl() . 'user/login');
        }
        $id = get('id');
//        var_dump($id);
        $order = $this->model->getUserOrder($id);
        if (!$order) {
           $this->error404();
        }

        $this->setMeta(___('user_order_title'));
        $this->set(compact('order'));

    }

    public function filesAction()
    {
         if (!User::checkAuth()) {
             redirect(baseUrl() . 'user/login');
         }
         $lang = App::$app->getProperty('language');
         $page = get('page');
         $per_page = App::$app->getProperty('pagination');
         $total = $this->model->getCountFiles();
         $pagination = new Pagination($page, $per_page, $total);
         $start = $pagination->getStart();
         $files = $this->model->getUserFiles($start, $per_page, $lang);
         $this->setMeta(___('user_files_title'));
         $this->set(compact('files', 'pagination', 'total'));
    }

    public function downloadAction()
    {
        if (!User::checkAuth()) {
            redirect(baseUrl() . 'user/login');
        }
        $id = get('id');
        $lang = App::$app->getProperty('language');
        $file = $this->model->getUserFile($id, $lang);
//        debug($id, 1);
//        debug(get('id'),1);

        if ($file) {
            $path = WWW . "/downloads/{$file['filename']}";
                if (file_exists($path)) {
                    header('Content-Type: application/octet-stream');
                    header('Content-Disposition: attachment; filename="' . basename($file['original_name']) . '"');
//                    header('Expires: 0');
                    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                    header('Pragma: public');
                    header('Content-Length: ' . filesize($path));
                    readfile($path);
                    exit();
                } else {
                    echo $this->error404('Помилка завантаження', 404);
//                    $_SESSION['errors'] = ___('user_download_error');
                }
             } else {
            echo $this->error404('Невірне посилання!', 404);
        }

        redirect();
    }




}














