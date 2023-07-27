<?php

namespace app\models\admin;

use app\models\AppModel;
use RedBeanPHP\R;

class Product extends AppModel
{

    public function getProducts($lang, $start, $per_page): array
    {
        return R::getAll("
        SELECT p.*, pd.title 
        FROM product AS p 
        JOIN product_description AS pd on p.id = pd.product_id 
        WHERE pd.language_id = ? LIMIT $start, $per_page",
        [$lang['id']]);
    }


}