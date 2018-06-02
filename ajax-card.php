<?php
/**
 * Created by PhpStorm.
 * User: hosein
 * Date: 5/30/2018
 * Time: 10:16 PM
 */


require_once "function.php";
require_once "model/product.php";
require_once "model/request.php";



if (isset($_COOKIE['card']))
{
    $card = unserialize($_COOKIE['card']);
}
else
    $card = array();



if ($_GET['type'] == "plus")
{
    $id = $_GET['id'];
    array_push($card,$id);
    setcookie('card', serialize($card), time()+3600);
}
else if ($_GET['type'] == "pop")
{
    $id = $_GET['id'];
    $index = array_search($id,$card);
    unset($card[$index]);
    setcookie('card', serialize($card), time()+3600);
}
else if ($_GET['type'] == "update")
{
    echo json_encode($card);
}
else if ($_GET['type'] == "getCard")
{
    $products = array();

    foreach ( $card as $p)
    {
        $product = new product();
        $p = (int)($p);
        $product->getProduct($p);
        array_push($products,$product);
    }
    echo json_encode($products);
}
