<?php

namespace wfm;
//                                       https://habr.com/ru/post/161483/
class ErrorHandler
{
    public function __construct()
    {
      if (DEBUG) {
            error_reporting(-1); // DEBUG повертає true
      } else {
            error_reporting(0); // DEBUG повертає false
        }
        set_exception_handler([$this, 'exceptionHandler']); //Встановлює визначену користувачем функцію обробки винятків;
        set_error_handler([$this, 'errorhandler']);
        ob_start();
        register_shutdown_function([$this, 'fatalErrorHandler']);
        }

    public function errorhandler($errNum, $errStr, $errFile, $errLine)
        {
        $this->logError($errStr, $errFile, $errLine);
        $this->displayError
        ($errNum, $errStr, $errFile, $errLine);
        }

    public function fatalErrorHandler()
        {
        $error = error_get_last();
      if (!empty($error) && $error['type'] & (E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR)) {
        $this->LogError($error['message'],  $error['file'],  $error['line']);
        ob_end_clean();
        $this->displayError($error['type'],  $error['message'],  $error['file'],  $error['line']);

      } else {
        ob_end_flush();
        }
        }

    public function exceptionHandler(\Throwable $e)
        {
        $this->logError($e->getMessage(), $e->getFile(),$e->getLine());
        $this->displayError('Виняток',$e->getMessage(), $e->getFile(),$e->getLine(), $e->getCode());
        }

    protected function LogError($message = '',  $file = '',  $line = '')
    {
        file_put_contents(
        LOGS . '/errors.log', //1.ARGUMENT: шлях запису данних;
        "[" . date('Y-m-d H:i:s') . "] 
        Error text: $message                                            
        | File: $file                        
        | String: $line 
        \n=================\n", //2.ARGUMENT: Які саме данні ми записуємо;
        FILE_APPEND);
    } //3.ARGUMENT: FILE_APPEND  - означає що дані будуть дозаписуватись в кінець файлу;


    protected function displayError($errNum, $errStr, $errFile, $errLine, $response = 500)
    {
      if ($response == 0) {
        $response = 404;
        }
        http_response_code($response);
      if ($response == 404 && !DEBUG) {
        require WWW . '/errors/404.php';
        die;
            }
      if (DEBUG)
            { // Якщо увімкнена відкладка
        require WWW . '/errors/development.php';
      } else { // Якщо відкладка вимкнена
        require WWW. '/errors/production.php';
        }
        die;
        }

    }


