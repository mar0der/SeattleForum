<?php
//PATHS AND DEFAULT FILES
$c['siteName'] = 'Seattle Forum';
$c['paths']['url'] = 'http://forum.petarpetkov.com/';
$c['paths']['avatarFolder'] = '/var/www/seattleforum/public/images/avatars/';
$c['paths']['avatarUrl'] = $c['paths']['url'].'images/avatars/';
$c['paths']['libs'] = '../libs/';
$c['paths']['controllers'] = '../controllers/';
$c['paths']['models'] = '../models/';
$c['paths']['views'] = '../views/';
$c['errorFile'] = 'Error.php';
$c['defaultFile'] = 'Index.php';
//DB CONFIGURATION
$c['database']['type'] = 'mysql';
$c['database']['host'] = 'localhost';
$c['database']['dbname'] = 'seattleForum';
$c['database']['username'] = 'seattleForum';
$c['database']['password'] = '';
//hashes
$c['salt'] = 'oDI;-A=qM_SF7}h/Eih5Z0SQ{X^Zpc24ezlQbJoq|VhRw[ARZ+}t,^w:Xen`o[n%';
