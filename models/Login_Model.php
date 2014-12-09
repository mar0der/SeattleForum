<?php

class Login_Model extends Model
{
    public function __construct($c)
    {
        parent::__construct($c);
    }

    public function run()
    {
        $sth = $this->db->prepare("SELECT * FROM users WHERE 
                username = :username AND password = :password");
        $sth->execute(array(
            ':username' => $_POST['username'],
            ':password' => Hash::create('sha256', $_POST['password'], $this->c->salt)
        ));
        $data = $sth->fetch();
        $count =  $sth->rowCount();

        if ($count > 0) {
            // login
            Session::init();
            Session::set('role', $data['role']);
            Session::set('loggedIn', true);
            Session::set('userid', $data['userid']);
            Session::set('username', $data['username']);
            Session::set('first_name', $data['first_name']);
            header('location: ../index');
        } else {
            header('location: ../login');
        } 
    }
}