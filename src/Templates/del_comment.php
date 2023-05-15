<?php

require_once '../bootstrap.php';

$db = Database::getInstance();
if(Input::exists('get')) {
    $db->delete(Config::get('comments.table'), ['id', '=', Input::get('id2')]);
    Session::setFlash("Комментарий успешно удален");
    Redirect::to('comment.php?id=' . Input::get('id'));
} else {
    Redirect::to('../index.php');
}

