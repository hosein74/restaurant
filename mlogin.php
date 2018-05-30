<?php
/**
 * Created by PhpStorm.
 * User: hosein
 * Date: 5/29/2018
 * Time: 2:03 PM
 */
require_once 'function.php';

if (isset($_POST) && !empty($_POST['username']) && !empty($_POST['password']) )
{
    $_SESSION['loginError']=login($_POST['username'],$_POST['password']);
}
redirect("login.php");
