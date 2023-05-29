<?php

namespace app\models;


use RedBeanPHP\R;



class WishList extends AppModel
{
    public function getWishProducts($id): array|null|string
    {
        return R::getCell
        (
            "SELECT id
            FROM product
            WHERE status = 1
            AND id = ?",
            [$id]
        );

    }

    public function addToWishList($id)
    {
        $wish_list = self::getWishListIds();
        if (!$wish_list) {
            setcookie('wishlist', $id, time() + 84600 * 7, '/');
        } else {
            if (!in_array($id, $wish_list)) {
                if (count($wish_list) > 5) {
                    array_shift($wish_list);
                }
                $wish_list[] = $id;
                $wish_list = implode(',', $wish_list);
                setcookie('wishlist', $wish_list, time() + 86400 * 7, '/');
            }
        }
    }

    public static function getWishListIds(): array
    {
        $wish_list = $_COOKIE['wishlist'] ?? '';
        if ($wish_list) {
            $wish_list = explode(',' ,$wish_list);
        }
        if (is_array($wish_list)) {
            $wish_list = array_slice($wish_list, 0, 6);
            $wish_list = array_map('intval', $wish_list);
            return $wish_list;
        }
        return [];
    }

    public function getWishListProductsByIds($lang): array
    {
        $wish_list = self::getWishListIds();
        if ($wish_list) {
            $wish_list = implode(',', $wish_list);
            return R::getAll
            (
                "
                SELECT p.*, pd.*
                FROM product p 
                JOIN product_description pd
                on p.id = pd.product_id
                WHERE p.status = 1
                AND p.id
                IN ($wish_list)
                AND pd.language_id = ?
                LIMIT 6",
                [$lang['id']]
            );
        }
        return [];

    }

    public function deleteFromWishList($id): bool
    {
        $wish_list = self::getWishListIds();//отримуємо массив Id's
        $key = array_search($id, $wish_list);
        if (false !== $key) {
             unset($wish_list[$key]);
             if ($wish_list) {
                 $wish_list = implode(',', $wish_list);
                 setcookie('wishlist', $wish_list, time() + 86400 * 7, '/');
             } else {
                 setcookie('wishlist', '', time()-3600, '/');
             }
             return true;
        }
        return false;
    }












}