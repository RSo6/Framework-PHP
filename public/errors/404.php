<?php
use wfm\App;
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0,
          maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>404 page</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Days+One">
    <link rel= "stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel = "stylesheet" href = "/public/errors/404.css">
</head>
<body>
<div class="scene">
    <div class = "box">
        <div class = "box__face front">4</div>
        <div class = "box__face back">0</div>
        <div class = "box__face right">4</div>
        <div class = "box__face left">0</div>
        <div class = "box__face top">Error</div>
        <div class= "box__face bottom">0</div>
    </div>
    <div class="shadow"></div>
</div>
<div class="desc">
    <h2>Ooops page not found!</h2>
    <button href="<?php echo PATH; ?>" class = "btn">BACK TO HOME</button>
</div>

</body>
</html>



