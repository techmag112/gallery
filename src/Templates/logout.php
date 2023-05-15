<?php

require_once '../bootstrap.php';

$user = new User;
$user->logout();

Redirect::to('../index.php');