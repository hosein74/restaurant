<?php
/**
 * Created by PhpStorm.
 * User: hosein
 * Date: 5/31/2018
 * Time: 4:42 PM
 */

require_once 'function.php';
require_once 'model/request.php';
if (isset($_POST) )
{
    foreach ($_POST['count'] as $key => $value)
        echo $key." => ".$value;
}

;
//redirect("login.php");

