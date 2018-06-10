<?php
/**
 * Created by PhpStorm.
 * User: hosein
 * Date: 5/13/2018
 * Time: 10:02 PM
 */

require_once './connection.php';


class product
{
    public $product_id ;
    public $product_name;
    public $product_cost;
    public $product_picture;


    function __construct()
    {

    }
    public function save()
    {
        $conn = DB::getInstance();
        $sql = $conn->prepare("INSERT INTO `product` (`product_id`, `product_name`, `product_cost`,`product_picture`)
                                        VALUES (NULL,:product_name,:product_cost,:product_picture)");
        $sql->bindParam(':product_name',$this->product_name);
        $sql->bindParam(':product_cost',$this->product_cost);
        $sql->bindParam(':product_picture',$this->product_picture);
        $sql->execute();
        $id = $conn->lastInsertId();
        $this->product_id = $id;
    }
    public function update()
    {
        $conn = DB::getInstance();
        $sql = $conn->prepare("UPDATE `product` SET `product_name`=:product_name,`product_cost`=:product_cost ,`product_picture`=:product_picture WHERE `product_id` = :product_id");
        $sql->bindParam(':product_id',$this->product_id);
        $sql->bindParam(':product_name',$this->product_name);
        $sql->bindParam(':product_cost',$this->product_cost);
        $sql->bindParam(':product_picture',$this->product_picture);
        $sql->execute();
    }
    public function delete($product)
    {
        $conn = DB::getInstance();
        $sql = $conn->prepare("DELETE FROM `product` WHERE product_id = :product_id");
        $sql->bindParam(':product_id',$product);
        $sql->execute();

    }
    public function getProduct($product)
    {
        $conn = DB::getInstance();
        $sql = $conn->prepare("select * from `product` WHERE product_id =:product_id");
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
            $this->product_picture = $thisUser['product_picture'];
            return true;
        }
        else
        {
            $this->product_id = null;
            $this->product_name = null;
            $this->product_cost = null;
            $this->product_picture = null;
            return false;
        }
    }
    public static function getProducts($start,$count)
    {
        $conn = DB::getInstance();
        $sql = $conn->query("select * from `product` LIMIT ".$count." OFFSET ".$start);
        $sql->execute();
        $result = $sql->setFetchMode(PDO::FETCH_ASSOC);
        $ac = $sql->fetchAll();
        return $ac;
    }
    public static function getAllCount()
    {
        $conn = DB::getInstance();
        $sql = $conn->prepare("SELECT COUNT(product_id) AS NumberOfProducts FROM product;");
        $sql->execute();
        $result = $sql->setFetchMode(PDO::FETCH_ASSOC);
        $ac = $sql->fetchAll();
        $count = $ac[0]['NumberOfProducts'];
        return $count;
    }

    public function getProductname($productname)
    {
        $conn = DB::getInstance();
        $sql = $conn->prepare("select * from `product` WHERE product_name =:product_name");
        $sql->bindParam(':product_name',$productname);
        $sql->execute();
        //$result = $sql->setFetchMode(PDO::FETCH_ASSOC);
        $ac = $sql->fetchAll();
        $numOfRow=$sql->rowCount();
        if ($numOfRow == 0)
        {
         
            return true;
        }
        else
        {
            return false;
        }
    }
	
	public function getaddresspic($id){
		$conn = DB::getInstance();
		$sql = $conn->prepare("select * from `product` WHERE product_id =:product_id");
        $sql->bindParam(':product_id',$id);
        $sql->execute();
		$ac=$sql->fetchAll();
		$result=$ac[0]['product_picture'];
		if($result)
			return $result;
		else
			return false;
		
		
	}


};


