<?php

//PATHS AND DEFAULT FILES
$c['siteName'] = 'Seattle Forum - a StackOverflow like forum!';
$c['paths']['url'] = 'http://forum.petarpetkov.com/';
$c['paths']['appFolder'] = '/var/www/seattleforum/';
$c['paths']['avatarFolder'] = $c['paths']['appFolder'] . 'public/images/avatars/';
$c['paths']['avatarUrl'] = $c['paths']['url'] . 'images/avatars/';
$c['paths']['aclConfig'] = $c['paths']['appFolder'] . 'config/Acl.conf.php';
$c['paths']['libs'] = $c['paths']['appFolder'] . 'libs/';
$c['paths']['controllers'] = $c['paths']['appFolder'] . 'controllers/';
$c['paths']['models'] = $c['paths']['appFolder'] . 'models/';
$c['paths']['views'] = $c['paths']['appFolder'] . 'views/';
$c['errorFile'] = 'Error.php';
$c['defaultFile'] = 'Index.php';
//DB CONFIGURATION
$c['database']['type'] = 'mysql';
$c['database']['host'] = 'localhost';
$c['database']['dbname'] = 'seattleForum';
$c['database']['username'] = 'seattleForum';
$c['database']['password'] = '123';
//hashes
$c['salt'] = 'oDI;-A=qM_SF7}h/Eih5Z0SQ{X^Zpc24ezlQbJoq|VhRw[ARZ+}t,^w:Xen`o[n%';
