<?php

/**
 * Format:
 * $acl = array('roleName' => array('controllersAllowed' => array ( 'displayedNameInMainMenu', array('allowedResources'))))
 */
$acl = array(
    'guest' => array(
        'error' => array('', array('error')),
        'login' => array('', array('index', 'logout', 'run')),
        'index' => array('', array('index')),
        'questions' => array('Home', array('index', 'category', 'tag')),
        'question' => array('', array('index', 'view')),
        'user' => array('', array('register', 'profile')),
        'about' => array('About', array('index'))
    ),
    'user' => array(
        'error' => array('', array('error')),
        'login' => array('', array('index', 'logout', 'run')),
        'index' => array('', array('index')),
        'questions' => array('Home', array('index', 'category', 'tag')),
        'question' => array('Ask', array('index', 'view', 'ask', 'edit')),
        'answer' => array('', array('index', 'add', 'edit')),
        'user' => array('My Profile', array('index', 'register', 'profile', 'edit')),
        'dashboard' => array(''),
        'about' => array('About', array('index'))
    ),
    'owner' => array(
        'error' => array('', array('error')),
        'login' => array('', array('index', 'logout', 'run')),
        'index' => array('', array('index')),
        'questions' => array('Home', array('index', 'category', 'tag')),
        'question' => array('Ask', array('index', 'view', 'ask', 'edit', 'delete')),
        'answer' => array('', array('index', 'add', 'edit', 'delete')),
        'user' => array('My Profile', array('index', 'register', 'profile', 'edit', 'delete', 'editBtn', 'deleteBtn')),
        'dashboard' => array(''),
        'about' => array('About', array('index')),
        'admin' => array('Admin Panel', array('index', 'create', 'edit', 'editSave', 'delete'))
    )
);



