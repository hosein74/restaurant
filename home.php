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

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
   <!-- <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.0.0/css/bootstrap.min.css" integrity="sha384-P4uhUIGk/q1gaD/NdgkBIl3a6QywJjlsFJFk7SPRdruoGddvRVSwv5qFnvZ73cpz" crossorigin="anonymous">
-->
</head>
<body>
<nav class="navbar navbar-light sticky-top bg-light">
<div nav-item >
    <a class="btn btn-info  " href="aut/register.php"><?php echo $logout?></a>
    <a class="btn btn-success  " href="aut/login.php"><?php echo $login?></a>
</div>

    <form name="lan" action="setLanguage.php" method="post" class="form-inline nav-item">
        <select class="custom-select-sm  " name="language" id="">
                    <option value="fa"><?php echo $fa?></option>
                    <option value="en"><?php echo $en?></option>
                </select>
        <input class="btn btn-warning m-1 " type="submit" name="" value="<?php echo $change?>">

    </form>


</nav>

<section>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active ">
                <img class="d-block w-100 " src="pics/deser.jpg" alt="<?php echo $deser?>">
                <div class="carousel-caption d-none d-md-block">
                    <h5><?php echo $deser?></h5>
                    <p><?php echo $deser_des?></p>
                </div>
            </div>
            <div class="carousel-item ">
                <img class="d-block w-100 " src="pics/fish.jpg" alt="<?php echo $fish?>">
                <div class="carousel-caption d-none d-md-block">
                    <h5><?php echo $fish?></h5>
                    <p><?php echo $fish_des?></p>
                </div>
            </div>
            <div class="carousel-item ">
                <img class="d-block w-100" src="pics/jooje.jpg" alt="<?php echo $jooje?>">
                <div class="carousel-caption d-none d-md-block">
                    <h5><?php echo $jooje?></h5>
                    <p><?php echo $jooje_des?></p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

</section>
<section>

</section>

<script src="node_modules/jquery/dist/jquery.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $('#carouselExampleSlidesOnly').carousel({
        interval: 2000
    })
</script>



</body>
</html>
