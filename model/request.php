<?php
/**
 * Created by PhpStorm.
 * User: hosein
 * Date: 5/13/2018
 * Time: 10:02 PM
 */

require_once './connection.php';


class request
{
    public $request_id;
    public $request_date;
    public $request_address;
    public $user_id;
    public $request_type;

    function __construct()
    {

    }
    public function save()
    {
        $conn = DB::getInstance();
        $sql = $conn->prepare("INSERT INTO `request` (`request_id`, `request_date`, `request_address`, `user_id`,`request_type`) 
                                        VALUES (NULL,:request_date,:request_address,:user_id,:request_type);SELECT LAST_INSERT_ID();");
        $sql->bindParam(':request_date',$this->request_date);
        $sql->bindParam(':request_address',$this->request_address);
        $sql->bindParam(':user_id',$this->user_id);
        $sql->bindParam(':request_type',$this->request_type);
        $sql->execute();
        $id = $conn->lastInsertId();
        $this->request_id = $id;
    }
    public function update()
    {
        $conn = DB::getInstance();
        $sql = $conn->prepare("UPDATE `request` SET `request_date`=:request_date,`request_address`=:request_address,`user_id`=:user_id,`request_type`=:request_type WHERE `request_id`=:request_id");
        $sql->bindParam(':request_id',$this->request_id);
        $sql->bindParam(':request_date',$this->request_date);
        $sql->bindParam(':request_address',$this->request_address);
        $sql->bindParam(':user_id',$this->user_id);
        $sql->bindParam(':request_type',$this->request_type);
        $sql->execute();

    }
    public function delete()
    {
        $conn = DB::getInstance();
        $sql = $conn->prepare("DELETE FROM `request` WHERE request_id = :request_id");
        $sql->bindParam(':request_id',$this->request_id);
        $sql->execute();

    }
    public function getRequest($req)
    {
        $conn = DB::getInstance();
        $sql = $conn->prepare("select * from `request` WHERE `request_id`=:request_id");
        $sql->bindParam(':request_id',$req);
        $sql->execute();
        $result = $sql->setFetchMode(PDO::FETCH_ASSOC);
        $ac = $sql->fetchAll();
        $numOfRow=$sql->rowCount();
        $thisUser = $ac[0];
        if ($numOfRow == 1)
        {
            $this->request_id = $thisUser['request_id'];
            $this->request_date = $thisUser['request_date'];
            $this->request_address = $thisUser['request_address'];
            $this->user_id = $thisUser['user_id'];
            $this->request_type = $thisUser['request_type'];
            return true;
        }
        else
        {

            $this->request_id = null;
            $this->request_date = null;
            $this->request_address = null;
            $this->user_id = null;
            $this->request_type = $thisUser['request_type'];
            return false;
        }

    }
    public static function getAllRequests()
    {
        $conn = DB::getInstance();
        $sql = $conn->query("select * from `request`");
        $sql->execute();
        $result = $sql->setFetchMode(PDO::FETCH_ASSOC);
        $ac = $sql->fetchAll();
        return $ac;
    }
}

