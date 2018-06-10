<?php
require_once 'function.php';
require_once 'model/product.php';

$id=$_POST['id'];
$newnamefood=$_POST['foodname'];
$newcostfood=$_POST['foodcost'];
$newpicture=$_FILES['picture'];

$product=new product();
$product=updatefood($id,$newnamefood,$newcostfood,$newpicture);

$data = array('id' => $product->product_id,'foodname' => $product->product_name,'costname' =>$product->product_cost,'targetfile' => $product->product_picture);
echo json_encode($data);

