<?php
/**
 * Created by PhpStorm.
 * User: hosein
 * Date: 5/14/2018
 * Time: 11:14 PM
 */
require_once "function.php";
setLang($_POST['language']);
header('Location: ' . $_SERVER['HTTP_REFERER']);