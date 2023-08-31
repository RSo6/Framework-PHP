<?php

namespace app\models\admin;

use app\models\AppModel;
use RedBeanPHP\R;
use wfm\App;

class Page extends AppModel
{

    public function getPages($lang, $start, $per_page): array
    {
        return R::getALL("SELECT p.*, pd.title 
                                FROM page AS p JOIN page_description AS pd 
                                    ON p.id = pd.page_id 
                                WHERE pd.language_id = ?
                                LIMIT $start, $per_page", [$lang['id']]);
    }

    public function deletePage($id): bool
    {
        R::begin();
        try {
            $page = R::load('page', $id);
            if (!$page) {
                return false;
            }
            R::trash($page);
            R::exec("DELETE FROM page_description WHERE page_id = ?", [$id]);
            R::commit();
            return false;
        } catch (\Exception $e){
                R::rollback();
                    return false;
        }
    }

    public function pageValidate(): bool
    {
        $errors = '';
        foreach ($_POST['page_description'] as $lang_id => $item) {
            $item['title'] = trim($item['title']);
            $item['content'] = trim($item['content']);
            if (empty($item['title'])) {
                $errors .= "Не заполнено Наименование во вкладке {$lang_id}<br>";
            }
            if (empty($item['content'])) {
                $errors .= "Не заполнено Контент во вкладке {$lang_id}<br>";
            }
        }

        if ($errors) {
            $_SESSION['errors'] = $errors;
            $_SESSION['form_data'] = $_POST;
            return false;
        }
        return true;
    }

    public function savePage(): bool
    {
        $lang = App::$app->getProperty('language')['id'];
        R::begin();
        try {
            // page
            $page = R::dispense('page');
            $page_id = R::store($page);
            $page->slug = AppModel::createSlug('page', 'slug', $_POST['page_description'][$lang]['title'], $page_id);
            R::store($page);

            // page_description
            foreach ($_POST['page_description'] as $lang_id => $item) {
                R::exec("INSERT INTO page_description (page_id, language_id, title, content, keywords, description) VALUES (?,?,?,?,?,?)", [
                    $page_id,
                    $lang_id,
                    $item['title'],
                    $item['content'],
                    $item['keywords'],
                    $item['description'],
                ]);
            }
            R::commit();
            return true;
        } catch (\Exception $e) {
            R::rollback();
            $_SESSION['form_data'] = $_POST;
            return false;
        }
    }

    public function getPage($id): array
    {
        return R::getAssoc("SELECT pd.language_id, pd.*, p.*
                FROM page_description pd JOIN page p ON p.id = pd.page_id WHERE pd.page_id = ?", [$id]);
    }


    public function updatePage($id): bool
    {
        R::begin();
        try {
            // page
            $page = R::load('page', $id);
            if (!$page) {
                return false;
            }


            // page_description
            foreach ($_POST['page_description'] as $lang_id => $item) {
                R::exec("UPDATE page_description SET title = ?, content = ?, keywords = ?, description = ? WHERE page_id = ? AND language_id = ?",
                    [
                    $item['title'],
                    $item['content'],
                    $item['keywords'],
                    $item['description'],
                    $id,
                    $lang_id,
                ]);
            }

            R::commit();
            return true;
        } catch (\Exception $e) {
            R::rollback();
            return false;
        }
    }
}