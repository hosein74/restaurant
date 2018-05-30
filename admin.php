<?php


require_once "function.php";
require_once getLang();


if (isLogin() && $_SESSION['type'] == 1)
{
    ?>

    <!doctype html>
    <html lang=fa>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link rel="stylesheet" href="style.css">
        <?php echo $link?>
    </head>
    <body>

    <?php require_once "nav.php" ?>

    </body>
    </html>
    <?php
}
else {

    redirect("index.php");
}
?>


