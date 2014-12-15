<?php

class Menu {
    /*
     * @return false if the object is not initialized properly
     */

    private static function loadMenuItems() {
        if (isset($_SESSION['role'])) {
            $role = $_SESSION['role'];
        } else {
            $role = 'guest';
        }
        $file = '../config/Acl.conf.php';
        if (file_exists($file)) {
            require $file;
            if (array_key_exists($role, $acl)) {
                return $acl[$role];
            } else {
                return false;
            }
        }
    }

    public static function renderMainMenu() {
        $menuItems = Menu::loadMenuItems();
        if ($menuItems) {
            $mainMenu = '<ul>';
            foreach ($menuItems as $v) {
                $path = Config::getValue("paths");
                $path = $path["url"];
                $mainMenu .= "<li><a class=\"menu-links\" href=\"" . $path . strtolower($v) . "\"/>" . $v . "</a></li>";
            }
            if (Session::get('loggedIn') == false) {
                $mainMenu .= "<li><a class=\"menu-links\" href=\"" . Config::getValue("url") . "login\">Login</a></li>";
            } else {
                $mainMenu .= "<li><a class=\"menu-links\" href=\"" . Config::getValue("url") . "login/logout\">Logout</a></li>";
            }
            $mainMenu .= '</ul>';
            echo $mainMenu;
        } else {
            echo 'Error loading main menu';
        }
    }

    public static function renderLoggedUser() {
        if (isset($_SESSION["first_name"])) {
            echo $_SESSION["first_name"];
        } else {
            echo "Guest";
        }
    }

}
