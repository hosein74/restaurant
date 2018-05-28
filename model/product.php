<?php
/**
 * Created by PhpStorm.
 * User: hosein
 * Date: 5/13/2018
 * Time: 10:02 PM
 */

class product
{
    public $product_id ;
    public $product_name;
    public $product_cost;


    function __construct()
    {

    }
    public function save()
    {
        $conn = DB::getInstance();
        $sql = $conn->prepare("INSERT INTO `product` (`product_id`, `product_name`, `product_cost`)
                                        VALUES (NULL,:product_name,:product_cost)");
        $sql->bindParam(':product_name',$this->product_name);
        $sql->bindParam(':product_cost',$this->product_cost);
        $sql->execute();
    }
    public function update()
    {
        $conn = DB::getInstance();
        $sql = $conn->prepare("UPDATE `product` SET `product_name`=:product_name,`product_cost`=:product_cost WHERE `product_id` = :product_id");
        $sql->bindParam(':product_id',$this->product_id);
        $sql->bindParam(':product_name',$this->product_name);
        $sql->bindParam(':product_cost',$this->product_cost);
        $sql->execute();
    }
    public function delete()
    {
        $conn = DB::getInstance();
        $sql = $conn->prepare("DELETE FROM `product` WHERE product_id = :product_id");
        $sql->bindParam(':product_id',$this->product_id);
        $sql->execute();

    }
    public function getProduct($product)
    {
        $conn = DB::getInstance();
        $sql = $conn->prepare("select * from `product` WHERE `product_id`=:product_id");
        $sql->bindParam(':product_id',$product);
        $sql->execute();
        $result = $sql->setFetchMode(PDO::FETCH_ASSOC);
        $ac = $sql->fetchAll();
        $numOfRow=$sql->rowCount();
        $thisUser = $ac[0];
        if ($numOfRow == 1)
        {
            $this->product_id = $thisUser['product_id'];
            $this->product_name = $thisUser['product_name'];
            $this->product_cost = $thisUser['product_cost'];
            return true;
        }
        else
        {

            $this->product_id = null;
            $this->product_name = null;
            $this->product_cost = null;
            return false;
        }

    }

};