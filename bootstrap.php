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
    // 'cookie' => [
    //     'cookie_name' => 'hash',
    //     'cookie_expiry' => 604800,
    //     'cookie_table' => 'user_sessions',
    // ]
];

// if(Cookie::exists(Config::get('cookie.cookie_name')) && !Session::exists(Config::get('session.user_session'))) {
//     $hash = Cookie::get(Config::get('cookie.cookie_name'));
//     $hashCheck = Database::getInstance()->get(Config::get('cookie.cookie_table'), ['hash', '=', $hash]);

//     if($hashCheck->count()) {
//         $user = new User($hashCheck->first()->user_id);
//         $user->login();
//     }
// }