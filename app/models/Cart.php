<?php

namespace app\models;

use RedBeanPHP\R;
class Cart extends AppModel
{

    public function getProduct($id, $lang):array //приймає id продукту і мову на якій цей продукт потрібно дістати | повертає массив
    {//метод getRow - повертає всі записи але виводить тільки одну
        return R::getRow("SELECT p.*, pd.* FROM product p JOIN product_description pd on p.id = pd.product_id WHERE p.status = 1 AND p.id = ? AND pd. language_id = ?", [$id, $lang['id']]);
        //SELECT - дістаєм ВСІ данні із таблиці продукту і теж самі з описом продукта FROM - з таблиці продукту
        //JOIN - приєднуєм данні з декількох таблиць:1-опис продукту =
        //WHERE - умова де стастус повинен бути 1(активним)
        //AND - вибір продукту потрібен бути обов'язковим
        //AND - і на вибраній мові повинен бути опис продукту
        //Два запити відповідно два параметри - id i lang де в lang нас цікавить id мови
    }

    public function addToCart($product, $qty = 1)
    {
        $qty = abs($qty);

        if ($product['is_download'] && isset($_SESSION['cart'][$product['id']])) {
             return false;
        }
        if (isset($_SESSION['cart'][$product['id']])) {
            $_SESSION['cart'][$product['id']]['qty'] += $qty;
        } else {
            if ($product['is_download']) {
                $qty = 1;
            }
            $_SESSION['cart'][$product['id']] = [
                'title' => $product['title'],
                'slug' => $product['slug'],
                'price' => $product['price'],
                'qty' => $qty,
                'img' => $product['img'],
                'is_download' => $product['is_download'],
            ];
        }

        $_SESSION['cart.qty'] = !empty($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] + $qty : $qty;
        $_SESSION['cart.sum'] = !empty($_SESSION['cart.sum']) ? $_SESSION['cart.sum'] + $qty * $product['price'] : $qty * $product['price'];
        return true;
    }

    public function deleteItem($id)
    {
        $qty_minus = $_SESSION['cart'][$id]['qty'];
        $sum_minus = $_SESSION['cart'][$id]['qty'] * $_SESSION['cart'][$id]['price'];
        $_SESSION['cart.qty'] -= $qty_minus;
        $_SESSION['cart.sum'] -= $sum_minus;
        unset($_SESSION['cart'][$id]);
    }

    public static function translateCart($lang)
    {
        if (empty($_SESSION['cart'])) {
            return;
        }
        $ids = implode(',', array_keys($_SESSION['cart']));
        $products = R::getAll("SELECT p.id, pd.title FROM product p JOIN product_description pd on p.id = pd.product_id WHERE p.id IN ($ids) AND pd.language_id = ?", [$lang['id']]);
        foreach ($products as $product) {
            $_SESSION['cart'][$product['id']]['title'] = $product['title'];
        }
    }






}
/*
 *Array
(
    [product_id] => Array
    (
        [qty] => QTY
        [title] => TITLE
         [price] => PRICE
         [img] => IMG
        )
    [product_id] => Array
(
    [qty] => QTY
    [title] => TITLE
    [price] => PRICE
    [img] => IMG
        )
    )
    [cart.qty] => QTY,
    [cart.sum] => SUM
*/

