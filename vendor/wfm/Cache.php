<?php

namespace wfm;

class Cache
{

    use TSingleton; //імпорт трейта
        //доступ до кешу через метод getInstance
    public function set($key, $data, $seconds = 3600): bool//1-ключ по якому будемо записувати данні в кеш
        //2-данні які ми хочемо записати в кеш, 3- к-сть часу на який ми записуєм данні в кеш, по замовч 1 год
    {
        $content['data'] = $data;//створюємо массив контент з ключем дата і записуємо в нього данні з змінної дата
        $content['end_time'] = time() + $seconds;
        if (file_put_contents(CACHE . '/' . md5($key) . '.txt', serialize($content))) {//пише данні в файл
            return true;
        } else {
            return false;
        }
    }

    public function get($key)//дістає з кешу
    {
        $file = CACHE . '/' . md5($key) . '.txt';//md5 - алгоритм хеширования
        if (file_exists($file)) { //перевірка чи існує перемінна $file
            $content = unserialize(file_get_contents($file));
            if (time() <= $content['end_time']) { //time - повертає поточну мітку системного часу
                return $content['data'];
            }
            unlink($file);//удаляє файл
        }
        return false;
    }

    public function delete($key)
    {
        $file = CACHE . '/' . md5($key) . '.txt';
        if (file_exists($file)) {
            unlink($file);
        }
    }
}