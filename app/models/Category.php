<?php

namespace app\models;

use RedBeanPHP\R;
use wfm\App;

class Category extends AppModel
{

    public function getCategory($slug, $lang): array
    {
        return R::getRow("SELECT c.*, cd. * FROM category c JOIN category_description cd on c.id = cd.category_id
        WHERE c.slug = ? AND cd.language_id = ?", [$slug, $lang['id']]);

    }

    public function getIds($id): string
    {
        $lang = App::$app->getProperty('language')['code'];
        $categories = App::$app->getProperty("categories_{$lang}");
        $ids = '';
        foreach ($categories as $k => $v) {
            if ($v['parent_id']== $id) {
                $ids .= $k . ',';
                $ids .= $this->getIds($k);
            }
        }
        return $ids;
    }

    public function getProducts($ids, $lang, $start, $per_page): array
    {
        return R::getAll("SELECT p.*, pd.* FROM product p JOIN product_description pd on p.id = pd.product_id
                 WHERE p.status = 1 AND p.category_id IN ($ids) AND pd.language_id = ? LIMIT $start, $per_page", [$lang['id']]);


    }

    public function getCountProducts($ids): int
    {
        return R::count('product', "category_id IN ($ids)");

    }


}