<?php


require_once 'connection.php';

function login($username)
{
    $_SESSION['time'] = time();
    $_SESSION['type'] = 1;  // todo : query from table user
    $_SESSION['user'] = ""; //todo : query from table user
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
            require_once "fa-lang.php";
        else if ($l == 'en')
            require_once "en-lang.php";
        else
            require_once "fa-lang.php";
    }
}
 ?>
