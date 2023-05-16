<?php

class ErrorController {

    private $user, $view;

    function __construct(User $user, Views $views) {
        $this->user = $user;
        $this->view = $views;
     }

    public function mainAction($method = 'post') {
        if($this->user->isLoggenIn()) {
            $this->view->render('404', array('username' => $this->user->data()->username));
        } else {
            $this->view->render('404_no_auth');   
        }  
    }
}