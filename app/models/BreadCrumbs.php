<?php

namespace app\models;


use wfm\App;


class BreadCrumbs extends AppModel
{

    public static function getBreadCrumbs($category_id, $name = ''):string
    {
        $lang = App::$app->getProperty('language')['code'];
        $categories = App::$app->getProperty("categories_{$lang}");
        $bread_crumbs_array = self::getParts($categories, $category_id);
//        debug($categories);
//        debug($bread_crumbs_array);
        //вивід іконки домика і посилання на головну сторінку
        $bread_crumbs = "<li class='breadcrumb-item'><a href='" . baseUrl() . "'>" . ___('tpl_home_breadcrumbs') . "</a></li>";
        if ($bread_crumbs_array) {
            foreach ($bread_crumbs_array as $slug => $title) {
                $bread_crumbs .= "<li class='breadcrumb-item'><a href='category/{$slug}'>{$title}</a></li>";
            }
        }
        if ($name) {//пристиковуємо імя продукту
            $bread_crumbs .= "<li class='breadcrumb-item active'>$name</li>";
        }
        return $bread_crumbs;

    }

    public static function getParts($cats, $id): array|false
    {
        if (!$id) {
            return false;
        }
        $bread_crumbs = [];
        foreach ($cats as $k => $v) {
            if (isset($cats[$id])) {
                $bread_crumbs[$cats[$id]['slug']] = $cats[$id]['title'];
                $id = $cats[$id]['parent_id'];
            } else {
                break;
            }
        }
        return array_reverse($bread_crumbs, true);
    }




}