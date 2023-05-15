<?php

class LoginController {

    private $user, $view, $validate;

    function __construct() {
        $this->user = new User();
        $this->view = new Views();
        $this->validate = new Validate();
    }

    public function logoutAction() {
        $this->user->logout();
        Redirect::to('/');
    }

    public function mainAction($method = 'post') {
        if(Input::exists()) {
            if(Token::check(Input::get('token'))) {       
                $this->validate->check($_POST, [
                    'email' => ['required' => true, 'email' => true],
                    'password' => ['required' => true],
                ]);
        
                if($this->validate->passed()) {
                    $remember = (Input::get('remember') === 'on') ? true : false;
        
                    $login = $this->user->login(Input::get('email'), Input::get('password'), $remember);
                    if($login) {
                        Redirect::to('/');
                    } else {
                        Session::setFlash("Неверный логин или пароль!", "danger");
                    }
                } else {
                    $errors = '';
                    foreach ($this->validate->error() as $error) {
                        $errors .= $error . '<br>';
                    }
                    Session::setFlash($errors, "danger");
                }
            }
        }   
        $this->view->render('login');     
    }
}