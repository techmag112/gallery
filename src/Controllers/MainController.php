<?php

class MainController {

    private $user, $images, $view;

    function __construct() {
        $this->user = new User();
        $this->images = new Images();
        $this->view = new Views();
    }

    public function mainAction($method = 'post') {
        // Если есть метод POST - добавить картинку
        if(Input::exists($method)) {
            if(Token::check(Input::get('token'))) {
                $this->images->putImage($_FILES['file'], $this->user->data()->id);   
            }
        }    
        // генерация вывода картинок
        if($this->user->isLoggenIn()) {
            $this->view->render('main_auth', array('gallery' => $this->images->getAllImage(), 'username' => $this->user->data()->username, 'id_user' => $this->user->data()->id));
        } else {
            $this->view->render('main_no_auth', [$gallery => $this->images->getAllImage()]);
        }

    }
}