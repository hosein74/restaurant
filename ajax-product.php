<?php
/**
 * Created by PhpStorm.
 * User: hosein
 * Date: 5/30/2018
 * Time: 5:30 PM
 */

require_once "function.php";
require_once "model/product.php";

$start = ($_GET['page']-1)*$_GET['count'];
$p = product::getProducts($start,$_GET['count']);
$a=product::getAllCount();
$data = array('product' => $p,'allCount' => $a);
echo json_encode($data);

