<?php

$acl = array(
    'guest' => array(
        'Index',
        'Questions',
        'About'
    ),
    'user' => array(
        'Index',
        'question',
        'Questions',
        'answer',
        'User',
        'dashboard',
        'About'
    ),
    'owner' => array(
        'Index',
        'question',
        'Questions',
        'answer',
        'User',
        'dashboard',
        'Admin',
        'About'
    )
);



