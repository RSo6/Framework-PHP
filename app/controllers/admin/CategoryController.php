<?php

namespace app\controllers\admin;

use app\models\admin\Category;
use RedBeanPHP\R;

/** @property Category $model */

class CategoryController extends AppController
{
    public function indexAction()
    {
        $title = 'Category';
        $this->setMeta("Admin :: {$title}");
        $this->set(compact('title'));
    }

    public function deleteAction()
    {
        $id = get('id');//дістаєм айді категорії
        $errors = '';
        $children = R::count('category', 'parent_id = ?', [$id]);  //дістаємо вкладені категорії з переданої категорії
        $products = R::count('product', 'category_id = ?', [$id]); //дістаємо товари з переданої категорії

        if ($children) { //якщо є вкладені категорії
            $errors .= 'Помилка! В категорії є вкладені категорії<br>';
        }
        if ($products) {//якщо в категорії є товари
            $errors .= 'В категорії є товари<br>';
        }
        if ($errors) {//якщо є помилки
            $_SESSION['errors'] = $errors; //пишем їх в сесію
            redirect();//редіректим на ту сторінку з якої прийшли
        } else { //інакше
        R::exec("DELETE FROM category WHERE id = ?", [$id]);//видаляємо категорію по айді
        R::exec("DELETE FROM category_description WHERE category_id = ?", [$id]);//видаляємо опис категорії по айді
        $_SESSION['success'] = 'Категорія успішно видалена';
        }
        redirect();
    }

    public function addAction()
    {
        if (!empty($_POST)) { //якщо пост не пустий
//            debug($_POST, 1);
            if ($this->model->categoryValidate()) {//валідуємо
                if ($this->model->saveCategory()) {//зберігаємо
                    $_SESSION['success'] = 'Категорія збережена';
                } else {
                    $_SESSION['errors'] = 'Помилка збереження категорії';
                }
            }
            redirect();
        }
        $title = 'Додавання категорії';
        $this->setMeta("Admin :: {$title}");
        $this->set(compact('title'));
    }
}













