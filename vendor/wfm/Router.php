<?php


namespace wfm;


class Router
{

    protected static array $routes = [];//тут зберігається таблиця маршрутів
    protected static array $route = [];//конкретно один маршрут з яким було знайдено співпадіння

    public static function add($regexp, $route = [])//за допомогою цього метода додаємо данні в $routes
    { //1 Аргумент шабон regexp який описує той чи інший url адрес, $route - співпадіння
        self::$routes[$regexp] = $route;//в таблицю маршрутів(по ключу $regexp) додаєм те що прийшло в $route
    }

    public static function getRoutes(): array
    {
        return self::$routes; //повертає всі наші маршрути
    }

    public static function getRoute(): array
    {
        return self::$route; //повертає конкретний маршрут
    }

    protected static function removeQueryString($url) //
    {
        if ($url) { // перевіряємо, чи є шлях загалом
            // розбиваємо шлях по амперсанту (маркер $_GET параметрів)
            $params = explode('&', $url, 2);
            /*	перевіряємо, чи немає в 0-му (першому) массиві після розбивки пари "ключ=значення"
			/	і якщо немає (якщо є, то це головна, тоді повертаємо false),
			/	то повертаємо обрізок без правого слешу
			*/
            if (false === str_contains($params[0], '=')) {
                return rtrim($params[0], '/');
            }
        }
        return '';
    }

    public static function dispatch($url)//приймає url адресу
    {
        // отримуємо чистий URL без GET
        $url = self::removeQueryString($url);//:: розширює область видимості
        // перевірка з правилами маршрутизації

        if (self::matchRoute($url)) { // формуємо простір імен з отриманого URL
           if (!empty(self::$route['lang'])) {
               App::$app->setProperty('lang', (self::$route['lang']));

           };
            $controller = 'app\controllers\\' . self::$route['admin_prefix'] . self::$route['controller'] . 'Controller';
            // перевірка, чи autoloader побачив такий класс
            if (class_exists($controller)) {
                // створюємо об'єкт контроллера
                /** @var Controller $controller_object */
                $controller_object = new $controller(self::$route);
                $controller_object->getModel();
                // формуємо action (метод) з отриманого URL або ж по замовчуванню
                $action = self::lowerCamelCase(self::$route['action'] . 'Action');
                // перевіряємо, чи такий метод існує у контексті екземпляру контроллера
                if (method_exists($controller_object, $action)) {
                    // викликаємо action (метод)
                    $controller_object->$action();
                    $controller_object->getView();
//                debug(self::matchRoute($url));
                } else {
                    throw new \Exception("Method {$controller}::{$action} Not Found", 404);
                }
            } else {
                throw new \Exception("Controller {$controller} Not Found", 404);
            }
        } else {
            throw new \Exception("Page Not Found", 404);
        }
    }


    public static function matchRoute($url): bool
    {
        // перебираємо дані, внесені методом Router::add
        foreach (self::$routes as $pattern => $route) {
            // звірка вхідного URL з регуляркою
            if (preg_match("~{$pattern}~", $url, $matches)) {
                // якщо є співпадіння, то заносимо до массиву $matches
                foreach ($matches as $k => $v) {
                    // заповнюємо тільки текстові індекси
                    if (is_string($k)) {
                        $route[$k] = $v;
                    }
                }
                // підставляємо метод по замовчуванню, якщо не передано в URL
                if (empty($route['action'])) {
                    $route['action'] = 'index';
                }
                // вказуємо ключ admin_prefix порожнім, якщо ми не в каталозі admin
                if (!isset($route['admin_prefix'])) {
                    $route['admin_prefix'] = '';
                } else {
                    $route['admin_prefix'] .= '\\';
                }
                // приводимо все до виду CamelCase
                $route['controller'] = self::upperCamelCase($route['controller']);
                // вносимо отримані дані до контейнера $route
                self::$route = $route;
                // повертаємось до called методу (bool)
                return true;
            }
        }

        return false;
}

    //CamelCase
    protected static function upperCamelCase($name): string
    {
        // заміна дефісу на пробіл
         //new-product => new product
        // приведення всіх слів до першої Великої літери
        //new product => New Product
        // прибираємо пробіл між словами
         //New Product => NewProduct
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
    }

    //camelCase
    protected static function lowerCamelCase($name): string
    {
        return lcfirst(self::upperCamelCase($name));//function "lcfirst" change first letter in lowerCase;
    }
}
