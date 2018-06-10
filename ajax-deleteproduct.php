<?php

require_once 'model/product.php';
$product=new product();
$product->delete($_GET['productid']);
echo $_GET['productid'];