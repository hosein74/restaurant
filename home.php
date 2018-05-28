<?php
/**
 * Created by PhpStorm.
 * User: hosein
 * Date: 5/14/2018
 * Time: 11:07 PM
 */

require_once 'model/user.php';
require_once 'function.php';
require_once getLang();



?>
<!doctype html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="aut/register.php"><?php echo $logout?></a>
    <a href="aut/login.php"><?php echo $login?></a>
    <form name="lan" action="setLanguage.php" method="post">
        <select name="language" id="">
            <option value="fa"><?php echo $fa?></option>
            <option value="en"><?php echo $en?></option>
        </select>
    </form>

</body>
</html>
