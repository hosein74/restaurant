<?php
/**
 * Created by dreamweaver
 * User: said
 * Date: 6/2/2018
 * Time: 12:33 PM
 */


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
        <title>Document1</title>
        <link rel="stylesheet" href="style.css">
        <?php echo $link?>

    </head>
    <body style="background-image: url(pics/pizza.jpg); background-repeat: no-repeat;background-size: cover">

    <?php require_once "nav.php" ?>


    <section class=" row justify-content-center">
        <form action="mregisterfood.php" method="post" enctype="multipart/form-data">
            <div class="card m-5"  style="width: 700px">
                <div class="card-header">
                    <?php echo $support?>
                </div>


                <div class="form-group">
                    <a  class="btn btn-success" href="getsupport.php"><?php echo $getsupportdatabase?></a>
                	<a  class="btn btn-info" href="updatesupport.php"><?php echo $updatesupportdatabase?></a>
                </div>

            </div>
        </form>

    </section>
    </body>
    </html>

    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <?php
}
else {

    redirect("index.php");
}
?>


              
  
