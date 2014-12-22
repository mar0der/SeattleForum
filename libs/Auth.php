<?php
/**
 * handle login
 */
class Auth
{    
    public static function handleLogin()
    {
        @session_start();
        $logged = $_SESSION['loggedIn'];
        if ($logged == false)
	{
            session_destroy();
            header('location: login');
            exit;
        }
    }
    
    public static function isAuth($resource)
    {
        if(isset($_SESSION['role'])){
            $role = $_SESSION['role'];
        }else{
            $role = 'guest';
        }
        $file = '../config/Acl.conf.php';
        if(file_exists($file)){
            require $file;
            if (array_key_exists($resource, $acl[$role])){
                return true;
            }
        }
        return false;
    }
}