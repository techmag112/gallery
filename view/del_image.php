<?php

require_once '../bootstrap.php';

$db = Database::getInstance();
if(Input::exists('get')) {
    $images = new Images();
    $images->removeImage(Input::get('id'));
    $db->delete(Config::get('comments.table'), ['id_img', '=', Input::get('id')]);
    Session::setFlash("Изображение успешно удалено");
}

Redirect::to('../index.php');