<?php
/**
 * Created by PhpStorm.
 * User: hosein
 * Date: 5/29/2018
 * Time: 12:46 PM
 */


?>

<nav class="navbar navbar-light sticky-top bg-light">


    <form name="lan" action="setLanguage.php" method="post" class="form-inline nav-item">
        <select class="custom-select-sm  " name="language" id="">
            <option value="fa"><?php echo $fa?></option>
            <option value="en"><?php echo $en?></option>
        </select>
        <input class="btn btn-warning m-1 " type="submit" name="" value="<?php echo $change?>">

    </form>
    <?php if (!isLogin()){ ?>
    <div nav-item >
        <a class="btn btn-info  " href="register.php"><?php echo $logout?></a>
        <a class="btn btn-success  " href="login.php"><?php echo $login?></a>
    </div>
    <?php }else{ ?>
    <div nav-item >
        <p class="text-dark d-inline-block  " ><?php echo $_SESSION['user']?></p>
        <a class="btn btn-success  " href="logout.php"><?php echo $exit?></a>
    </div>
    <?php } ?>

</nav>
