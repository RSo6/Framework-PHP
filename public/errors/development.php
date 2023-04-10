<?php

/**
 * @var $err_num ErrorHandler
 * @var $err_str ErrorHandler
 * @var $err_file ErrorHandler
 * @var $err_line ErrorHandler
 */

use wfm\ErrorHandler;

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
            <title>Помилка</title>
</head>
<body>

    <h1>Виникла помилка!!!</h1>
        <p><b>Код помилки:</b> <?php echo $err_num ?></p>
            <p><b>Текст помилки:</b> <?php echo $err_str ?></p>
                <p><b>Файл, в якому виникла помилка:</b> <?php echo $err_file ?></p>
                    <p><b>Рядок, в якому виникла помилка:</b> <?php echo $err_line ?></p>

</body>
</html>


