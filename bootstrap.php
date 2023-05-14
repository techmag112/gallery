<?php

require_once 'classes/Database.php';
require_once 'classes/Config.php';
require_once 'classes/Input.php';
require_once 'classes/Validate.php';
require_once 'classes/Token.php';
require_once 'classes/Session.php';
require_once 'classes/User.php';
require_once 'classes/Redirect.php';
require_once 'classes/Images.php';

session_start();

$GLOBALS['config']  =   [
    'mysql' => [
        'host' => 'localhost:3400',
        'username' => 'root',
        'password' => '',
        'database' => 'project',
    ],            
    'session' => [
        'token_name' => 'token',
        'user_session' => 'users'
    ],
    'images' => [
        'size' => 2000000,
        'path' => '/uploads/img/',
        'ext' => 'jpg,bmp,gif,png',
        'table' => "images"
    ],
    'comments' => [
        'table' => "comments"
    ],
];

