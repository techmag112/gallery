<?php

class MainController {

    private $user, $images, $view, $db;

    function __construct() {
        $this->user = new User();
        $this->images = new Images();
        $this->view = new Views();
        $this->db = Database::getInstance();
    }

    public function mainAction($method = 'post') {
        if($method === 'get' && Input::exists($method)) {
            $this->images->removeImage(Input::get('id'));
            $this->db->delete(Config::get('comments.table'), ['id_img', '=', Input::get('id')]);
            Session::setFlash("Изображение успешно удалено");
        } elseif(Input::exists($method)) {
            // Если есть метод POST - добавить картинку
            if(Token::check(Input::get('token'))) {
                $this->images->putImage($_FILES['file'], $this->user->data()->id);   
            }
        }    
        // генерация вывода картинок
        if($this->user->isLoggenIn()) {
            $this->view->render('main_auth', array('gallery' => $this->images->getAllImage(), 'username' => $this->user->data()->username, 'id_user' => $this->user->data()->id));
        } else {
            $this->view->render('main_no_auth', ['gallery' => $this->images->getAllImage()]);
        }

    }
}