<?php

namespace app\models;

use RedBeanPHP\R;
use wfm\App;

class Category extends AppModel
{
    public function getCategory($slug, $lang): array
    {
        return R::getRow(
            "SELECT c.*, cd. * 
                  FROM category c 
                  JOIN category_description cd 
                  on c.id = cd.category_id
                  WHERE c.slug = ? 
                   AND cd.language_id = ?",
                   [$slug, $lang['id']]
        );

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
//        debug($ids,1);
        return $ids;
    }

   public function getProducts($ids, $lang, $start, $per_page): array
    {
        $sort_values = [
            'title_asc' => 'ORDER BY title ASC',
            'title_desc' => 'ORDER BY title DESC',
            'price_asc' => 'ORDER BY price ASC',
            'price_desc' => 'ORDER BY price DESC',
            'date_release_asc' => 'ORDER BY date_release ASC',
        ];
        $order_by = '';
        if (isset($_GET['sort']) && array_key_exists($_GET['sort'], $sort_values)) {
            $order_by = $sort_values[$_GET['sort']];
        }

        //return R::getAll("SELECT p.*, pd.* FROM product p JOIN product_description pd on p.id = pd.product_id WHERE p.status = 1 AND p.category_id IN ($ids) AND pd.language_id = ? $order_by LIMIT $start, $perpage", [$lang['id']]);
        return R::getAll("
            SELECT p.*, pd.* 
            FROM product p 
            JOIN product_description pd on p.id = pd.product_id 
            JOIN product_to_category ptc 
            ON (p.id = ptc.product_id) 
            WHERE p.status = 1 
            AND ptc.category_id 
            IN ($ids) 
            AND pd.language_id = ?
             $order_by 
            LIMIT $start, $per_page",
            [$lang['id']]);
    }

    public function getCountProducts($ids): int
    {
        return R::count('product_to_category', "category_id IN ($ids)");
    }


}