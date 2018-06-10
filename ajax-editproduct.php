<?php
require_once 'function.php';
require_once 'model/product.php';
print_r($_POST);
echo "<br/>";

echo "<br/>";
print_r($_FILES);
echo "<br/>";

echo "<br/>";
//echo $_POST['foodname'];
if($_POST['foodname']){
	
	echo $_POST['foodname'];
	
}else if($_POST['foodcost']){
	
	echo $_POST['foodcost'];
	
}else if($_FILES['picture']){
	
	echo $_FILES['picture'];
	
}


	