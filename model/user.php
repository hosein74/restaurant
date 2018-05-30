<?php
/**
 * Created by PhpStorm.
 * User: hosein
 * Date: 5/13/2018
 * Time: 10:02 PM
 */

require_once './connection.php';

class user
{
    public $user_id;
    public $user_name;
    public $user_family;
    public $user_username;
    public $user_password;
    public $user_phone;
    public $user_address;
    public $user_email;
    public $user_type;

    function __construct()
    {

    }
    public function save()
    {
        $conn = DB::getInstance();
        $sql = $conn->prepare("INSERT INTO `user` (`user_id`, `user_name`, `user_family`, `user_username`, `user_password`, `user_phone`, `user_address`, `user_email`,`user_type`) 
                                                          VALUES (NULL,:user_name,  :user_family,  :user_username,  :user_password,  :user_phone,  :user_address,  :user_email,:user_type)");
        $sql->bindParam(':user_name',$this->user_name);
        $sql->bindParam(':user_family',$this->user_family);
        $sql->bindParam(':user_username',$this->user_username);
        $sql->bindParam(':user_password',$this->user_password);
        $sql->bindParam(':user_phone',$this->user_phone);
        $sql->bindParam(':user_address',$this->user_address);
        $sql->bindParam(':user_email',$this->user_email);
        $sql->bindParam(':user_type',$this->user_type);
        $sql->execute();

    }
    public function update()
    {
        $conn = DB::getInstance();
        $sql = $conn->prepare("UPDATE `user` SET `user_name`=:user_name,`user_family`=:user_family,`user_username`=:user_username,`user_password`=:user_password,`user_phone`=:user_phone,`user_address`=:user_address,`user_email`=:user_email,`user_type`=:user_type  WHERE `user_username`=:user_username");
        $sql->bindParam(':user_name',$this->user_name);
        $sql->bindParam(':user_family',$this->user_family);
        $sql->bindParam(':user_username',$this->user_username);
        $sql->bindParam(':user_password',$this->user_password);
        $sql->bindParam(':user_phone',$this->user_phone);
        $sql->bindParam(':user_address',$this->user_address);
        $sql->bindParam(':user_email',$this->user_email);
        $sql->bindParam(':user_type',$this->user_type);
        $sql->execute();
    }
    public function delete()
    {
        $conn = DB::getInstance();
        $sql = $conn->prepare("DELETE FROM `user` WHERE user_username = :user_username");
        $sql->bindParam(':user_username',$this->user_username);
        $sql->execute();

    }
    public function getUser($user)
    {
        $conn = DB::getInstance();
        $sql = $conn->prepare("select * from `user` WHERE `user_username`=:user_username");
        $sql->bindParam(':user_username',$user);
        $sql->execute();
        $result = $sql->setFetchMode(PDO::FETCH_ASSOC);
        $ac = $sql->fetchAll();
        $numOfRow=$sql->rowCount();
        $thisUser = $ac[0];
        if ($numOfRow == 1)
        {
            $this->user_id = $thisUser['user_id'];
            $this->user_name = $thisUser['user_name'];
            $this->user_family = $thisUser['user_family'];
            $this->user_username = $thisUser['user_username'];
            $this->user_password = $thisUser['user_password'];
            $this->user_phone = $thisUser['user_phone'];
            $this->user_address = $thisUser['user_address'];
            $this->user_email = $thisUser['user_email'];
            $this->user_type = $thisUser['user_type'];

            return true;
        }
        else
        {

            $this->user_id = null;
            $this->user_name = null;
            $this->user_family = null;
            $this->user_username = null;
            $this->user_password = null;
            $this->user_phone = null;
            $this->user_address = null;
            $this->user_email = null;
            $this->user_type = null;
            return false;
        }

    }




}