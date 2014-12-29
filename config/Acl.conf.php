<?php

//all controllers names must start with capital leter
$acl = array(
    'guest' => array(
        'Error' => array('', array('error', 'noauth')),
        'Login' => array('',array('index', 'logout', 'run')),
        'Index' => array('', array('index')),
        'Questions' => array('Home', array('index', 'category', 'tag')),
        'Question' => array('', array('index', 'view')),
        'User' => array('', array('register')),
        'About' => array('About', array('index'))
    ),
    'user' => array(
        'Error' => array('', array('error', 'noauth')),
        'Login' => array('',array('index', 'logout', 'run')),
        'Index' => array('', array('index')),
        'Questions' => array('Home', array('index', 'category', 'tag')),
        'Question' => array('Ask', array('index', 'view', 'ask', 'edit')),
        'Answer' => array('', array('index', 'add', 'edit')),
        'User' => array('My Profile', array('index' ,'register', 'profile', 'edit')),
        'Dashboard' => array(''),
        'About' => array('About', array('index'))
    ),
    'owner' => array(
        'Error' => array('', array('error', 'noauth')),
        'Login' => array('',array('index', 'logout', 'run')),
        'Index' => array('', array('index')),
        'Questions' => array('Home', array('index', 'category', 'tag')),
        'Question' => array('Ask', array('index', 'view', 'ask', 'edit', 'delete')),
        'Answer' => array('', array('index', 'add', 'edit', 'delete')),
        'User' => array('My Profile', array('index' ,'register', 'profile', 'edit', 'delete')),
        'Dashboard' => array(''),
        'About' => array('About', array('index')),
        'Admin' => array('Admin Panel', array('index','create' ,'edit', 'editSave', 'delete'))
    )
);



