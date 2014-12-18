<?php

$acl = array(
    'guest' => array(
        'index',
        'Questions',
        'Question',
        'About'
    ),
    'user' => array(
        'index',
        'Question',
        'Questions',
        'answer',
        'User',
        'dashboard',
        'About'
    ),
    'owner' => array(
        'index',
        'Question',
        'Questions',
        'answer',
        'User',
        'dashboard',
        'Admin',
        'About'
    )
);



