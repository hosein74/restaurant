<?php
/**
 * Created by dreamweaver
 * User: said
 * Date: 6/2/2018
 * Time: 6:39 PM
 */

require_once 'function.php';
$targetdir="pics/";

if (isset($_POST) && !empty($_POST['foodname'])  && !empty($_POST['foodcost']) && !empty($_POST['picture']))
{
	
	$target_file=$targetdir.basename($_FILES["picture"]["name"]);
	$fileformat=pathinfo($target_file,PATHINFO_EXTENSION);
	if(file_exists($target_file))
		echo "file exit";
	else{
		
		if(move_uploaded_file($_FILES["picture"]["tmp_name"],$target_file))
			echo "upload ok";
		else
			echo "upload false";
	}
    $_SESSION['registerfoodError']=registerfood($_POST['foodname'],$_POST['foodcost'],$target_file);
}
redirect("registerfood.php");
