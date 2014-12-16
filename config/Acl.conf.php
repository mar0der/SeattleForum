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
        'Answer',
        'User',
        'dashboard',
        'About'
    ),
    'owner' => array(
        'Index',
        'question',
        'Questions',
        'Answer',
        'User',
        'dashboard',
        'Admin',
        'About'
    )
);



