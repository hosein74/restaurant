<?php


require_once 'connection.php';
require_once 'model/user.php';


function login($username,$password)
{
    $user = new user();
    $result =  $user->getUser($username);
    if ($result & $user->user_password == $password)
    {
            $_SESSION['time'] = time();
            $_SESSION['type'] = $user->user_type;
            $_SESSION['user'] = $user->user_name;
            return true;
    }
    else
        return false;

}
function redirect()
{
    if (isset($_SESSION['time']) && ($_SESSION['time']- time()) < 3600 && isset($_SESSION['type']) ) {
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
          $_SESSION['time'] = NULL;
          $_SESSION['type'] = NULL;
          $_SESSION['user'] = NULL;
          header("location:home.php");
      }
    }
    else {
        header("location:home.php");
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
 ?>
