<?php

require_once 'src' . DIRECTORY_SEPARATOR . 'Core' . DIRECTORY_SEPARATOR .'Database.php';
require_once 'src' . DIRECTORY_SEPARATOR . 'Core' . DIRECTORY_SEPARATOR .'Config.php';
require_once 'src' . DIRECTORY_SEPARATOR . 'Core' . DIRECTORY_SEPARATOR .'Input.php';
require_once 'src' . DIRECTORY_SEPARATOR . 'Core' . DIRECTORY_SEPARATOR .'Validate.php';
require_once 'src' . DIRECTORY_SEPARATOR . 'Core' . DIRECTORY_SEPARATOR .'Token.php';
require_once 'src' . DIRECTORY_SEPARATOR . 'Core' . DIRECTORY_SEPARATOR .'Session.php';
require_once 'src' . DIRECTORY_SEPARATOR . 'Core' . DIRECTORY_SEPARATOR .'User.php';
require_once 'src' . DIRECTORY_SEPARATOR . 'Core' . DIRECTORY_SEPARATOR .'Redirect.php';
require_once 'src' . DIRECTORY_SEPARATOR . 'Core' . DIRECTORY_SEPARATOR .'Images.php';
require_once 'src' . DIRECTORY_SEPARATOR . 'Core' . DIRECTORY_SEPARATOR .'Cookie.php';
require_once 'src' . DIRECTORY_SEPARATOR . 'Core' . DIRECTORY_SEPARATOR .'Router.php';
require_once 'src' . DIRECTORY_SEPARATOR . 'Controllers' . DIRECTORY_SEPARATOR .'MainController.php';
require_once 'src' . DIRECTORY_SEPARATOR . 'Core' . DIRECTORY_SEPARATOR .'Views.php';

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
        'path' => '/public/uploads/img/',
        'ext' => 'jpg,bmp,gif,png',
        'table' => "images"
    ],
    'comments' => [
        'table' => "comments"
    ],
    'cookie' => [
        'cookie_name' => 'hash',
        'cookie_expiry' => 604800,
        'cookie_table' => 'user_sessions',
    ]
];

Cookie::autologin();