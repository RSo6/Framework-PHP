<?php                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       

function debug($data, $die = false)// просто функція для гарного виводу на екран
{
    echo '<pre>' . print_r($data, 1) . '</pre>';
    if ($die) {
        die;
    }
}

function h($str)
{
    return $str ? htmlspecialchars($str,  ENT_COMPAT, 'UTF-8') : '';
}

function redirect($http = false)
{
     if ($http) { //якщо переданий http
         $redirect = $http; //тоді ми в перемінну редірект записуєм цей http
     } else {//перевіка якщо в массиві сервера існує ключ http_referer(адрес з якого він прийшов) то в цьому випадку ми візьмем його
         $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;//інший випадок відправимо на головну сторінку
     }
     header("Location: $redirect");//робимо редірект на ту сторінку яка попала в перемінну редірект
     die;//закінчуємо наступне виконання коду
}

function baseUrl()
{
    // PATH = http://new-myshop.loc + / + en + / якщо такого нема то додамо пустий рядок
    return PATH . '/' .(\wfm\App::$app->getProperty('lang') ? \wfm\App::$app->getProperty('lang') . '/' : '');
}

/**
 * @param string $key Key of GET array
 * @param string $type Values 'i', 'f', 's'
 * @return float|int|string
 */
function get($key, $type = 'i')
{
    $param = $key;
    $$param = $_GET[$param] ?? '';//$page = $_GET['page'] ?? ''
    if ($type == 'i') {
        return (int)$$param;
    } elseif ($type == 'f') {
        return (float)$$param;
    } else {
        return trim($$param);
    }
}
/**
 * @param string $key Key of POST array
 * @param string $type Values 'i', 'f, 's'
 * @return float|int|string
 */
function post($key, $type = 's')
{
    $param = $key;
    $$param = $_POST[$param] ?? '';
    if ($type == 'i') {
        return (int)$$param;
    } elseif ($type == 'f') {
        return (float)$$param;
    } else {
        return trim($$param);
    }
}

function __($key)
    {
        echo \wfm\Language::get($key);
    }

function ___($key)
    {
        return \wfm\Language::get($key);
    }

function getCartIcon($id)
{
    if (!empty($_SESSION['cart']) && array_key_exists($id, $_SESSION['cart'])) {
        $icon = '<i class="fas fa-luggage-cart"></i>';
    } else {
        $icon = '<i class="fas fa-shopping-cart"></i>';
    }
    return $icon;
}

function getFieldValue($name)
{
    return isset($_SESSION['form_data'][$name]) ? h($_SESSION['form_data'][$name]) : '';
}

















