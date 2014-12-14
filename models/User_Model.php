<?php

class User_Model extends Model 
{

    public function __construct($c) 
    {
        parent::__construct($c);
    }
    
    public function addUser($username, $password, $email, $realName="", $gender="", $avatar=""){
        //use var_dump for debugging//use var_dump for debugging
        return $isDone;
    }
    
    public function editUser($userId, $password = "", $email="", $realName = "", $gender="", $avatar=""){
        //use var_dump for debugging
        return $isDone;
    }
    
    public function viewUser($userId){
        // var_dump($outputArra); //use this row to check if the returnet result is what you expect
        return $outputArray;
    }
    
    public function deleteUser($userId){
        //use var_dump for debugging
        return $isDone;
    }
}