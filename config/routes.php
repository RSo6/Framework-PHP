<?php

use wfm\Router;//імпортуєм простір імен
//^ i $ = початок і кінець;
Router::add('^admin/?$', ['controller' => 'Main', 'action' => 'index', 'admin_prefix' => 'admin']);
Router::add('^admin/(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', ['admin_prefix' => 'admin']);
//"+" - значить що в параметрах повинен бути мінімум один символ

//slug - це унікальний фрагмент URL-адресу ассоційований з конкретним записом;
Router::add('^(?P<lang>[a-z]+)?/?product/(?P<slug>[a-z0-9-]+)/?$', ['controller' => 'Product', 'action' => 'view']);

Router::add('^(?P<lang>[a-z]+)?/?category/(?P<slug>[a-z0-9-]+)/?$', ['controller' => 'Category', 'action' => 'view']);

Router::add('^(?P<lang>[a-z]+)?/?search/?$', ['controller' => 'Search', 'action' => 'index']);
Router::add('^(?P<lang>[a-z]+)?/?wishlist/?$', ['controller' => 'WishList', 'action' => 'index']);

Router::add('^(?P<lang>[a-z]+)?/?page/(?P<slug>[a-z0-9-]+)/?$', ['controller' => 'Page', 'action' => 'view']);

Router::add('^(?P<lang>[a-z]+)?/?$', ['controller' => 'Main', 'action' => 'index']);

Router::add('^(?P<controller>[a-z-]+)/(?P<action>[a-z-]+)/?$');
Router::add('^(?P<lang>[a-z]+)/(?P<controller>[a-z-]+)/(?P<action>[a-z-]+)/?$');


