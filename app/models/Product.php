<?php

namespace app\models;

use RedBeanPHP\R;
use wfm\App;

class Product extends AppModel
{
    public function getProduct($slug, $lang): array
    {
        return R::getRow("SELECT p.*, pd.* 
            FROM product p 
            JOIN product_description pd 
            on p.id = pd.product_id 
            WHERE p.status = 1 
              AND p.slug = ? 
              AND pd.language_id = ?", [$slug, $lang['id']]);

    }

    public function getGallery($product_id): array //функція яка дістає фото для продукту по його id
    {//Створюємо запит до бази данних і витягуємо фото для нашого продукту
        return R::getAll("SELECT * FROM product_gallery WHERE product_id = ?", [$product_id]);

    }


}