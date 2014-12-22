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
            $mainMenu = '<nav><ul>';
            foreach ($menuItems as $v) {
                if ($v != strtolower($v)) {
                    $path = Config::getValue("paths");
                    $path = $path["url"];
                    $mainMenu .= "<li><a class=\"menu-links\" href=\"" . $path . strtolower($v) . "\"/>" . $v . "</a></li>";
                }
            }
            //is logged it
            if (Session::get('loggedIn') == false) {
                $mainMenu .= "<li><a class=\"menu-links\" href=\"" . Config::getValue("url") . "/login\">Login</a></li>"
                        . "<li><a class=\"menu-links\" href=\"" . Config::getValue("url") . "/user/register\">Register</a></li>";
            } else {
                $mainMenu .= "<li><a class=\"menu-links\" href=\"" . Config::getValue("url") . "/login/logout\">Logout</a></li>";
            }
            $mainMenu .= '</ul></nav>';
            echo $mainMenu;
        } else {
            echo 'Error loading main menu! Please contact site administrator.';
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
