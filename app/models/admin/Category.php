<?php

namespace app\models\admin;

use app\models\AppModel;
use RedBeanPHP\R;
use wfm\App;

class Category extends AppModel
{
    public function categoryValidate(): bool
    {
        $errors = '';
        foreach ($_POST['category_description'] as $lang_id => $item) {
            $item['title'] = trim($item['title']);
            if (empty($item['title'])) {
                $errors .= "Назва не заповнена на вкладці {$lang_id} <br>";
            }
        }
        if ($errors) {
            $_SESSION['errors'] = $errors;
            $_SESSION['form_data'] = $_POST;
            return false;
        }
        return true;
    }

    public function saveCategory(): bool
    {
        $lang = App::$app->getProperty('language')['id'];
//        debug($lang);
        R::begin();
        try {
            $category = R::dispense('category');
            $category->parent_id = post('parent_id', 'i');
            $category_id = R::store($category);
            $category->slug = AppModel::createSlug(
                'category',
                'slug',
                $_POST['category_description'][$lang]['title'],
                $category_id
            );
            R::store($category);
            foreach ($_POST['category_description'] as $lang_id => $item) {
                R::exec(
                    "INSERT INTO category_description 
    (category_id, language_id, title, description, keywords, content) VALUES (?,?,?,?,?,?)",
                    [
                        $category_id,
                        $lang_id,
                        $item['title'],
                        $item['description'],
                        $item['keywords'],
                        $item['content']
                    ]
                );
            }
            R::commit();
        } catch (\Exception $e) {
            R::rollback();
            return false;
        }
        return true;
    }

    public function updateCategory($id): bool
    {
        R::begin();
        try {
            $category = R::load('category', $id);
            if (!$category) {
                return false;
            }
            $category->parent_id = post('parent_id', 'i');
            R::store($category);
            foreach ($_POST['category_description'] as $lang_id => $item) {
                R::exec(
                    "UPDATE category_description 
                           SET title = ?, 
                               description = ?,
                               keywords = ?,
                               content = ? 
                            WHERE category_id = ?
                            AND language_id = ?
                           ",
                    [
                        $item['title'],
                        $item['description'],
                        $item['keywords'],
                        $item['content'],
                        $id,
                        $lang_id,
                    ]
                );
            }
            R::commit();
        } catch (\Exception $e) {
            R::rollback();
            return false;
        }
        return true;
    }

    public function getCategory($id): array
    {
        return R::getAssoc("
            SELECT cd.language_id, cd.*, c.*
        FROM category_description cd 
            JOIN category c on c.id = cd.category_id 
        WHERE cd.category_id = ?",
            [$id]);
    }
}















