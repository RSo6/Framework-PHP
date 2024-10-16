<?php

namespace app\models;

use RedBeanPHP\R;

class Search extends AppModel
{
    public function getCountFindProducts($s, $lang): int
    {
        return R::getCell
        (
            "SELECT COUNT(*) 
                  FROM product p 
                  JOIN product_description pd 
                  on p.id = pd.product_id
                  WHERE p.status = 1
                  AND pd.language_id = ?
                  AND pd.title
                  LIKE ?",
                  [$lang['id'], "%{$s}%"]

        );
    }

    public function getFindProducts($s, $lang, $start, $per_page): array
    {
        return R::getAll
        (
            "SELECT p.*, pd.* 
                 FROM product p
                 JOIN product_description pd
                 ON p.id = pd.product_id
                 WHERE p.status = 1
                 AND pd.language_id = ?
                 AND pd.title
                 LIKE ?
                 LIMIT $start, $per_page",
                [$lang['id'], "%{$s}%"]
        );

    }



}