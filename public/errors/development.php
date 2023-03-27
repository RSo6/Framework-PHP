<?php

/**
 * @var $errNum ErrorHandler
 * @var $errStr ErrorHandler
 * @var $errFile ErrorHandler
 * @var $errLine ErrorHandler
 */

use wfm\ErrorHandler;

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
            <title>Ошибка</title>
</head>
<body>

    <h1>Виникла помилка!!!</h1>
        <p><b>Код помилки:</b> <?= $errNum ?></p>
            <p><b>Текст помилки:</b> <?= $errStr ?></p>
                <p><b>Файл, в якому виникла помилка:</b> <?= $errFile ?></p>
                    <p><b>Рядок, в якому виникла помилка:</b> <?= $errLine ?></p>

</body>
</html>


