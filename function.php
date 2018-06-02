<?php


require_once 'connection.php';
require_once 'model/user.php';
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
    $newReq->request_date = time();
    $newReq->request_address = $thisUser->user_address;
    $newReq->user_id = $thisUser->user_id;
    $newReq->request_type = 1;

}
 ?>
