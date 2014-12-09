<?php

class Menu {
/*
 * @return false if the object is not initialized properly
 */
    private static function loadMenuItems()
    {
        if(isset($_SESSION['role'])){
            $role = $_SESSION['role'];
        }else{
            $role = 'guest';
        }
        $file = '../config/Acl.conf.php';
	if(file_exists($file)){
	    require $file;
	    if (array_key_exists($role, $acl)){
		return $acl[$role];
            }else{
                return false;
            }
        }
    }
    
    public static function renderMainMenu()
    {
	$menuItems = Menu::loadMenuItems();
	if($menuItems)
        {
            $mainMenu = '';
            foreach($menuItems as $v)
	    {
                $mainMenu .= "<a href=\"/".strtolower($v)."\"/>".$v."</a> ";
            }
	    echo $mainMenu;
        }
        else
        {
            echo 'Error loading main menu';
        }
    }
    
    public static function renderLoggedUser()
    {
	if(isset($_SESSION["first_name"]))
	{
	    echo $_SESSION["first_name"];
	}else
	{
	    echo "Guest";
	}
    }
}
