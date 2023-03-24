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

<h1>Произошла ошибка</h1>
<p><b>Код ошибки:</b> <?= $errNum ?></p>
<p><b>Текст ошибки:</b> <?= $errStr ?></p>
<p><b>Файл, в котором произошла ошибка:</b> <?= $errFile ?></p>
<p><b>Строка, в которой произошла ошибка:</b> <?= $errLine ?></p>

</body>
</html>


