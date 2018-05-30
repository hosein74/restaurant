<?php
/**
 * Created by PhpStorm.
 * User: hosein
 * Date: 5/30/2018
 * Time: 11:36 AM
 */

require_once 'function.php';

if (isset($_POST) && !empty($_POST['fname'])  && !empty($_POST['lname']) && !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password1']) && !empty($_POST['address']) && !empty($_POST['phone']) )
{
    $_SESSION['registerError']=register($_POST['fname'],$_POST['lname'],$_POST['username'],$_POST['email'],$_POST['password'],$_POST['password1'],$_POST['address'],$_POST['phone']);
}
redirect("register.php");
