<?php


require_once 'connection.php';
require_once 'model/user.php';
require_once 'model/listrequest.php';
require_once 'model/product.php';
session_start();

function isLogin()
{
    if (isset($_SESSION['time']) && ( time() - $_SESSION['time']) < 3600)
        return true;
    else
        return false;

}
function login($username,$password)
{

    $user = new user();
    $result =  $user->getUser($username);
    if ($result & $user->user_password == $password)
    {
            $_SESSION['time'] = time();
            $_SESSION['type'] = $user->user_type;
            $_SESSION['user'] = $user->user_username;
            return true;
    }
    else
        return false;

}
function logout()
{
    $_SESSION['time'] = null;
    $_SESSION['type'] = null;
    $_SESSION['user'] = null;
}

function register($fname,$lname,$username,$email,$password,$password1,$address,$phone)
{

        $user = new user();
        $result =  $user->getUser($username);
        if (!$result && $password == $password1)
        {
            $newUser = new user();
            $newUser->user_name = $fname;
            $newUser->user_family = $lname;
            $newUser->user_username = $username;
            $newUser->user_password = $password;
            $newUser->user_email = $email;
            $newUser->user_address = $address;
            $newUser->user_phone = $phone;
            $newUser->user_type = 2;
            $newUser->save();
            $_SESSION['time'] = time();
            $_SESSION['type'] = $newUser->user_type;
            $_SESSION['user'] = $newUser->user_username;
            return true;
        }
        else
            return false;


}

function editUser($fname,$lname,$username,$email,$password,$password1,$address,$phone)
{

    $user = new user();
    $result =  $user->getUser($_SESSION['user']);
    if ($result && $password == $password1)
    {
        $newUser = new user();
        $newUser->user_name = $fname;
        $newUser->user_family = $lname;
        $newUser->user_username = $_SESSION['user'];
        $newUser->user_password = $password;
        $newUser->user_email = $email;
        $newUser->user_address = $address;
        $newUser->user_phone = $phone;
        $newUser->user_type = 2;
        $newUser->update();
        return true;
    }
    else
        return false;
}


function redirect($url)
{

    if ( isLogin() && isset($_SESSION['type']) ) {
      if ($_SESSION['type'] == 1)
      {
          header("location:admin.php");
      }
      else if ($_SESSION['type']== 2)
      {
          header("location:user.php");
      }
      else
      {

          header("location:".$url);
      }
    }
    else {
        header("location:".$url);
    }
}
function setLang($lang)
{
    setcookie('lang',$lang) ;
}
function getLang()
{
    if (isset($_COOKIE['lang']))
    {
        $l = $_COOKIE['lang'];
        if ($l == 'fa')
            return "fa-lang.php";
        else if ($l == 'en')
            return "en-lang.php";
        else
            return "fa-lang.php";
    }
    else
        return "fa-lang.php";

}

function setRequest($card)
{
    $thisUser = new user();
    $thisUser->getUser($_SESSION['user']);
    $newReq = new request();
    $newReq->request_date = date('Y-m-d H:i:s');
    $newReq->request_address = $thisUser->user_address;
    $newReq->user_id = $thisUser->user_id;
    $newReq->request_type = 1;
    $newReq->save();

    $l = new listrequest();
    foreach ($card as $p_id => $p_num)
    {
        $l->request_id = $newReq->request_id;
        $l->product_id = (int)$p_id;
        $l->listrequest_num = (int)$p_num;
        $l->save();
    }
}


function registerfood($foodname,$foodcost,$picture)
{

    $product = new product();
    $result =  $product->getProductname($foodname);
    if ($result)
    {
		$targetdir = "pics/";
		$pict=$picture["name"];

    $target_file=$targetdir.$pict;
    //die($target_file);
    $fileformat=pathinfo($target_file,PATHINFO_EXTENSION);
    if($fileformat=='jpg'){

        if(file_exists($target_file))
            echo "file exit";
        else{	
            if(move_uploaded_file($picture["tmp_name"],$target_file))
			{
				echo "upload ok";
				echo $target_file;
			 	$newproduct =new product();
        		$newproduct->product_name = $foodname;
        		$newproduct->product_cost = $foodcost;
        		$newproduct->product_picture = $target_file;
        		$newproduct->save();
				
        		return true;
			}
            else
			{
				echo "upload false";
				return false;
			}
                
        }
    }
		else
		{
			echo "not jpg";
			return false;

		}
		
       
    }
    else
	{
		echo "name fod exist";
        return false;
	}
		


}

function deletefood($id){
	
	$product=new product();
	$addressfile=$product->getaddresspic($id);
	if($addressfile){
	
		unlink($addressfile);
		$product->delete($id);
	}
}

function updatefood($id,$newnamefood,$newcostfood,$newpicture){
	
	$targetdir = "pics/";
	$pict=$newpicture['name'];
	$targetfile=$targetdir.$pict;

	$oldproduct=new product();
	$oldproduct->getProduct($id);

	$product=new product();
	$product->product_id=$id;

	if($newnamefood)
	{
		$product->product_name=$newnamefood;
	}else{
		$product->product_name=$oldproduct->product_name;
	}

	if($newcostfood){
		$product->product_cost=$newcostfood;
	}else{
		$product->product_cost=$oldproduct->product_cost;
	}

	if($newpicture['error']==0){
	
		$product->product_picture=$targetfile;
		$formet=pathinfo($product->product_picture,PATHINFO_EXTENSION);
		if($formet=='jpg'){
			unlink($oldproduct->product_picture);
			$product->update();
			if(file_exists($targetfile)){

			}else{
		
				if(move_uploaded_file($newpicture['tmp_name'],$product->product_picture)){

				}
			}
		}else{
			$product->product_picture=$oldproduct->product_picture;
			$product->update();
		}
	
	}else{
		$product->product_picture=$oldproduct->product_picture;
		$product->update();
	}
	
	
	return $product;
	
}


function backup_tables($host,$user,$pass,$name,$tables = '*')
{
	$return="";
	$link = mysqli_connect($host,$user,$pass,$name);
	mysqli_select_db($link,$name);
	mysqli_query($link,"SET NAMES 'utf8'");
	//mysqli_connect()
	//get all of the tables
	if($tables == '*')
	{
		$tables = array();
		$result = mysqli_query($link,'SHOW TABLES');
		while($row = mysqli_fetch_row($result))
		{
			$tables[] = $row[0];
		}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	
	foreach($tables as $table)
	{
		$result = mysqli_query($link,'SELECT * FROM '.$table);
		$num_fields = mysqli_num_fields($result);
		
		$return.= 'DROP TABLE '.$table.';';
		$row2 = mysqli_fetch_row(mysqli_query($link,'SHOW CREATE TABLE '.$table));
		$return.= "\n\n".$row2[1].";\n\n";
		
		for ($i = 0; $i < $num_fields; $i++) 
		{
			while($row = mysqli_fetch_row($result))
			{
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j < $num_fields; $j++) 
				{
					$row[$j] = addslashes($row[$j]);
					$row[$j] = ereg_replace("\n","\\n",$row[$j]);
					//$row[$j]=preg_replace("\n","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j < ($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";
	}
	
	//save file
	
	$handle = fopen('db-backup.sql','w+');
	//$handle = fopen('db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql','w+');
	fwrite($handle,$return);
	fclose($handle);
}



 ?>
