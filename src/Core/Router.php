<?php

class Router {

    private array $routes = ['/' => [0],
                '/login' => [1],
                '/logout' => [1, 'logoutAction'],
                '/register' => [1, 'regAction'],
                '/comment' => [3], 
                '/update' => [1, 'updateAction'],
                '/changepass' => [1, 'changepassAction'],
    ], $controllers = [];

    function __construct(MainController $controller1, LoginController $controller2, ErrorController $controller3, CommentController $controller4) {
        $this->controllers[0] = $controller1;
        $this->controllers[1] = $controller2;
        $this->controllers[2] = $controller3;
        $this->controllers[3] = $controller4;
    }

    public function run() {

        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];
        
        // Strip query string (?foo=bar) and decode URI
         if (false !== $pos = strpos($uri, '?')) {
             $uri = substr($uri, 0, $pos);
         }
         $uri = rawurldecode($uri);

          $action = $this->routes[$uri][1] ?? 'mainAction';
          $controller = isset($this->routes[$uri][0]) ? $this->controllers[$this->routes[$uri][0]] : $this->controllers[2];
          $controller->$action(mb_strtolower($httpMethod));

    }

}