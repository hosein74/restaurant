<?php
/**
 * Created by dreamweaver
 * User: said
 * Date: 6/2/2018
 * Time: 6:39 PM
 */
//salam

require_once 'function.php';
require_once 'model/product.php';
$targetdir="pics/";
if (isset($_POST) && !empty($_POST['foodname'])  && !empty($_POST['foodcost']) && !empty($_FILES['picture']))
{
    $_SESSION['registerfoodError']=registerfood($_POST['foodname'],$_POST['foodcost'],$_FILES['picture']);
}
//redirect("registerfood.php");
