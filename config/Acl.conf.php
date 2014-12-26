<?php

//all controllers names must start with capital leter
$acl = array(
    'guest' => array(
        'Index' => array(''),
        'Questions' => array('Home'),
        'Question' => array('Ask'),
        'About' => array('About')
    ),
    'user' => array(
        'Index' => array(''),
        'Questions' => array('Home'),
        'Question' => array('Ask'),
        'Answer' => array(''),
        'User' => array('My Profile'),
        'Dashboard' => array(''),
        'About' => array('About')
    ),
    'owner' => array(
        'Index' => array(''),
        'Questions' => array('Home'),
        'Question' => array('Ask'),
        'Answer' => array(''),
        'User' => array('My Profile'),
        'Dashboard' => array(''),
        'About' => array('About'),
        'Admin' => array('Admin Panel')
    )
);



