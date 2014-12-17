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
    
    public function saveEditedUser($userId, $password = "", $email="", $role, $realName = "", $gender="", $avatar=""){
        $data=array(
        		'password'=> $password,
    			'email'=> $email,
                'role'=>$role,
    			'first_name'=>$realName,
    			'gender'=>$gender,
    			'avatar'=>$avatar
        			);
      
         return ($this->db->update('users', $data, "userid = $userId"));
        
    }
    
    public function viewUser($userId){
        return ($this->db->select("SELECT userid, username, role, first_name, score, registered_on, email, gender, last_login, avatar FROM users WHERE userid = :userid", array(':userid' => $userId)));
    }
    
    public function deleteUser($userId){    
        return $this->db->delete('users', array('userid' => $userId)); 
    }
    public function isUserExist($username){
    	return ((bool)$this->db->select("SELECT userid, username, role FROM users WHERE username = :username", array(':username' => $username)));
    }
   
}