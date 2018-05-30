<?php
/**
 * Created by PhpStorm.
 * User: hosein
 * Date: 5/29/2018
 * Time: 4:45 PM
 */

require_once 'function.php';
$_SESSION['loginError']=false;
logout();
redirect("home.php");