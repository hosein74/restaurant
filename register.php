<?php
/**
 * Created by PhpStorm.
 * User: hosein
 * Date: 5/29/2018
 * Time: 5:16 PM
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
    <body style="background-image: url(pics/pizza.jpg); background-repeat: no-repeat;background-size: cover">

    <?php require_once "nav.php" ?>


    <section class=" row justify-content-center">
        <form action="mregister.php" method="post">
        <div class="card m-5"  style="width: 700px">
            <div class="card-header">
                <?php echo $personal?>
            </div>
            <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="lname"><?php echo $lname?></label>
                            <input name="lname" type="text" class="form-control" id="lname" placeholder="<?php echo $lname?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="fname"><?php echo $fname?></label>
                            <input name="fname" type="text" class="form-control" id="fname" aria-describedby="emailHelp" placeholder="<?php echo $fname?>">
                        </div>
                    </div>
            </div>
            <div class="card-header">
                <?php echo $userinf?>
            </div>
        <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email"><?php echo $email?></label>
                        <input name="email" type="text" class="form-control" id="email" placeholder="<?php echo $email?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="username"><?php echo $username?></label>
                        <input name="username" type="text" class="form-control" id="username" aria-describedby="emailHelp" placeholder="<?php echo $username?>">
                    </div>
                </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="password1"><?php echo $password1?></label>
                    <input name="password1" type="password" class="form-control" id="password1" placeholder="<?php echo $password1?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="password"><?php echo $password?></label>
                    <input name="password" type="password" class="form-control" id="password"  placeholder="<?php echo $password?>">
                </div>
            </div>
        </div>
            <div class="card-header">
                <?php echo $locationinf?>
            </div>
            <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="phone"><?php echo $phone?></label>
                    <input name="phone" type="text" class="form-control" id="email" placeholder="<?php echo $phone?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="address"><?php echo $address?></label>
                    <input name="address" type="text" class="form-control" id="address"  placeholder="<?php echo $address?>">
                </div>
            </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary"><?php echo $logout?></button>
                </div>
            </div>

        </div>
        </form>

    </section>
    </body>
    </html>

    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

<?php } ?>
