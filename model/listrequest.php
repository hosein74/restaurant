<?php
/**
 * Created by PhpStorm.
 * User: hosein
 * Date: 6/2/2018
 * Time: 11:53 AM
 */

require_once './connection.php';

class listrequest
{
    public $request_id;
    public $product_id ;
    public $listrequest_num;


    function __construct()
    {

    }
    public function save()
    {
        $conn = DB::getInstance();
        $sql = $conn->prepare("INSERT INTO `listrequest`(`request_id`, `product_id`, `listrequest_num`)
                                        VALUES (:request_id,:product_id,:listrequest_num)");
        $sql->bindParam(':request_id',$this->request_id);
        $sql->bindParam(':product_id',$this->product_id);
        $sql->bindParam(':listrequest_num',$this->listrequest_num);
        $sql->execute();
    }
    public static function getProductsOfRequest($request)
    {
        $conn = DB::getInstance();
        $sql = $conn->prepare("select `product`.`product_id`,`product_name`,`product_cost`,`listrequest_num` from `listrequest` INNER JOIN `product` ON `listrequest`.`product_id` = `product`.`product_id`  WHERE `request_id` =:request_id");
        $sql->bindParam(':request_id',$request);
        $sql->execute();
        $result = $sql->setFetchMode(PDO::FETCH_ASSOC);
        $ac = $sql->fetchAll();
        return $ac;
    }
};