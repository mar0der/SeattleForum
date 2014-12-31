<?php

/**
 * handle login
 */
class Auth {

    public static function handleLogin() {
        @session_start();
        $logged = $_SESSION['loggedIn'];
        if ($logged == false) {
            session_destroy();
            header('location: login');
            exit;
        }
    }

    public static function isAuth($resource) {
        global $c;
        $resource = array_map("trim", preg_split("/\//", $resource));
        $resource = array_map("strtolower", $resource);
        $role = Session::get('role');
        if (!isset($role)) {
            $role = 'guest';
        }
        $acl = array();
        $aclConfigFile = $c->paths->aclConfig;
        
        if (file_exists($aclConfigFile)) {
            require $aclConfigFile;
            if (@in_array($resource[1], array_map("strtolower",@$acl[$role][$resource[0]][1]))) {
                return true;
            } else {
                return false;
            }
        } else {
            require $c->paths->controllers . $c->errorFile;
            $e = new Error();
            $e->index(array("No acl config file found!"));
            return false;
        }
    }

}
