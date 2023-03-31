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
            <title>Помилка</title>
</head>
<body>

    <h1>Виникла помилка!!!</h1>
        <p><b>Код помилки:</b> <?php echo $errNum ?></p>
            <p><b>Текст помилки:</b> <?php echo $errStr ?></p>
                <p><b>Файл, в якому виникла помилка:</b> <?php echo $errFile ?></p>
                    <p><b>Рядок, в якому виникла помилка:</b> <?php echo $errLine ?></p>

</body>
</html>


