<?php

/**
 *
 */
class DB
{
  public static $host = "localhost";
  public static $database = "resturant" ;
  public static $username = "root";
  public static $password = "";

  private static $instance = null;
  function __construct(){
  }
  function __clone()
  {
  }

    public static function getInstance()
  {
    if (!isset(self::$instance)) {
      self::$instance = new PDO("mysql:host=".self::$host.";dbname=".self::$database.";charset=utf8",self::$username,self::$password) or die("connection error");
    }
    return self::$instance;
  }

}

 ?>

