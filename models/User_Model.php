<?php
class User_Model extends Model 
{

    public function __construct($c) 
    {
        parent::__construct($c);
    }
    
    public function addUser($data){
    	$data['password']= Hash::create('sha256', $data['password'], Config::getValue("salt"));
    	return ($this->db->insert('users',$data));
 		
    }
    
    public function saveEditedUser($userId, $password = "", $email="", $realName = "", $gender="", $avatar=""){
        $data=array(
        		'password'=> $password,
    			'email'=> $email,
    			'first_name'=>$realName,
    			'gender'=>$gender,
    			'avatar'=>$avatar
        			);
      
        return ($this->db->update('users', $data, "userid = $userId"));
        
    }
    
    public function viewUser($userId){
        return ($this->db->select("SELECT username, role, first_name, score,registered_on, last_login, avatar FROM users WHERE userid = :userid", array(':userid' => $userId)));
    	//return ($this->db->select("SELECT userid, username, role FROM users WHERE userid = :userid", array(':userid' => $userId)));
    }
    
    public function deleteUser($userId){
       // var_dump($this->db->delete('mytable', array('userid' => $userId))); 
        return $isDone;
    }
    public function isUserExist($username){
    	return ((bool)$this->db->select("SELECT userid, username, role FROM users WHERE username = :username", array(':username' => $username)));
    }
   
}