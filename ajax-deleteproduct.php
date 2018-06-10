<?php

require_once 'model/product.php';
$product=new product();
$product->delete($_GET['productid']);
//echo "<script>console.log( 'salam');</script>";
//deletefood($_GET['productid']);
$file="pics/gorme.jpg";
unlink($file);
echo $_GET['productid'];