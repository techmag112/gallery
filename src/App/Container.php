<?php

class Container {

    private array $objects = [];

    function __construct() {
        $this->objects = [
            'db' => fn() => Database::getInstance(),
            'view' => fn() => new Views(), 
            'images' => fn() => new Images($this->get('db')),
            'validate' => fn() => new Validate($this->get('db')),
            'user' => fn() => new User($this->get('db')),
            'commentcontroller' => fn() => new CommentController($this->get('view'), $this->get('user'), $this->get('images'), $this->get('db')),
            'logincontroller' => fn() => new LoginController($this->get('user'), $this->get('view'), $this->get('validate')),
            'errorcontroller' => fn() => new ErrorController($this->get('user'), $this->get('view')),
            'maincontroller' => fn() => new MainController( $this->get('user'), $this->get('images'), $this->get('view'), $this->get('db')),
            'router' => fn() => new Router($this->get('maincontroller'), $this->get('logincontroller'), $this->get('errorcontroller'), $this->get('commentcontroller')),
        ];
    }

    public function has(string $id) {
        return isset($this->objects[$id]);
    }

    public function get(string $id) {
        return $this->objects[$id]();
    }

}