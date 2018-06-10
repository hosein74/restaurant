<?php
/**
 * Created by PhpStorm.
 * User: hosein
 * Date: 6/2/2018
 * Time: 4:50 PM
 */


require_once "function.php";
require_once "model/product.php";
require_once "model/request.php";


if ($_GET['type'] == "payed")
{
    $id = $_GET['id'];
    $req = new request();
    $req->getRequest($id);
    $req->request_type = 2;
    $req->update();
    echo json_encode($req->request_id);
}
elseif ($_GET['type'] == "verify")
{
    $id = $_GET['id'];
    $req = new request();
    $req->getRequest($id);
    $req->request_type = 3;
    $req->update();
    echo json_encode($req->request_id);
}