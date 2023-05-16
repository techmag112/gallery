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

    public function regAction($method = 'post') {
        if(Input::exists()) {
            if(Token::check(Input::get('token'))) {
                $validation = $this->validate->check($_POST, [
                    'username' => [
                        'required' => true,
                        'min' => 2,
                        'max' => 15,
                        'unique' => 'users'
                    ],
                    'email' => [
                        'required' => true,
                        'email' => true,
                        'unique' => 'users'
                    ],
                    'password' => [
                        'required' => true,
                        'min' => 3,
                    ],
                    'password_again' => [
                        'required' => true,
                        'matches' => 'password',
                    ],
                ]);
        
                if($validation->passed()) {
                    $this->user->create([
                        'username' => Input::get('username'),
                        'password' => password_hash(Input::get('password'), PASSWORD_DEFAULT),
                        'email' => Input::get('email'),
                    ]);
        
                    Session::setFlash("Регистрация успешно выполнена");
                    Redirect::to('/');
        
                } else {
                    $errors = '';
                    foreach ($this->validate->error() as $error) {
                        $errors .= $error . '<br>';
                    }
                    Session::setFlash($errors, "danger");
                }
            }
        }
        $this->view->render('register');     
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