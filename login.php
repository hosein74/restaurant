<?php
/**
 * Created by PhpStorm.
 * User: hosein
 * Date: 5/29/2018
 * Time: 12:37 PM
 */


require_once 'function.php';
require_once getLang();

if (isLogin())
{
    redirect("index.php");
}
else{

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
 <body style="background-image: url(pics/cake.jpg); background-repeat: no-repeat;background-size: cover ;">

 <?php require_once "nav.php" ?>


 <section class=" row justify-content-center">
     <div class="card m-5" style="width: 500px ">
         <div class="card-header">
             <?php echo $enter?>
         </div>
        <div class="card-body">

            <form action="mlogin.php" method="post">
                <div class="form-group">
                    <label for="user"><?php echo $username?></label>
                    <input name="username" type="text" class="form-control" id="user" aria-describedby="emailHelp" placeholder="<?php echo $username?>">
                </div>
                <div class="form-group">
                    <label for="password"><?php echo $password?></label>
                    <input name="password" type="password" class="form-control" id="password" placeholder="<?php echo $password?>">
                </div>
                <div class="form-group ">
                    <button type="submit" class="btn btn-primary"><?php echo $login?></button>
                </div>
            </form>
        </div>
     </div>

 </section>
 </body>
 </html>

    <script src="node_modules/jquery/dist/jquery.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

<?php } ?>
