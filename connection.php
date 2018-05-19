<?php

/**
 *
 */
class DB
{
  private static $host ;
  private static $database ;
  private static $username ;
  private static $password ;

  private static $instance = NULL;
  function __construct($h="localhost",$db = "res",$un="root",$p=""){
    $host = $h;
    $database = $db;
    $username = $un;
    $password = $p;
  }

  public static function getInstance()
  {
    if (isset(self::$instance)) {
      self::$instance = new PDO("mysql:host=".self::$host.";dbname=".self::$database.";charset=utf8",self::$username,self::$password) or die("connection error");
    }
    return self::$instance;
  }

}



 ?>
