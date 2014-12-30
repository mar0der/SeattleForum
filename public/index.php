<?php

header('Content-Type: text/html; charset=utf-8');
//error_reporting(1);
//for debugging only use v($something) to faster do <pre> var_dump() </pre>.
//and vd($something) for v + die. Comment netxt line for production env

require '../libs/Debug.php'; //only for development env
require '../libs/Config.php';
require '../libs/Auth.php';

$c = new Config('../config/config.inc.php');

//@TODO: Also spl_autoload_register (Take a look at it if you like)
function __autoload($class) {
    global $c;
    require $c->paths->libs . $class . ".php";
}

//Start the session before everything else
session_start();
// Load the Bootstrap!
$bootstrap = new Bootstrap();
//Init bootstrap with config object
$bootstrap->init();
