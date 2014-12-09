<?php
//for debugging only use v($something) to faster do <pre> var_dump() </pre>. comment next row for production
require '../libs/Debug.php';
require '../libs/Config.php';
require '../libs/Auth.php';
$c = new Config('../config/config.inc.php');
//@TODO: Also spl_autoload_register (Take a look at it if you like)
function __autoload($class) 
{
    global $c;
    require $c->paths->libs . $class .".php";
}
//Start the session before everything else
session_start();
// Load the Bootstrap!
$bootstrap = new Bootstrap();
//Init bootstrap with config object
$bootstrap->init($c);
