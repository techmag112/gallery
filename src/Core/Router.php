<?php

class Router {

    private array $routes = [
        '/' => [MainController::class],
        '/login' => [LoginController::class],
        '/logout' => [LoginController::class, 'logoutAction'],
        '/register' => [RegisterController::class],
        '/comment' => [CommentController::class],
        '/del_comment' => [CommentController::class, 'deleteAction'],
        '/image' => [ImageController::class],
    ];

    public function run() {

        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];
        
        // Strip query string (?foo=bar) and decode URI
         if (false !== $pos = strpos($uri, '?')) {
             $uri = substr($uri, 0, $pos);
         }
         $uri = rawurldecode($uri);

         if (isset($this->routes[$uri])) {
            $action = $this->routes[$uri][1] ?? 'mainAction';
            $controller = new $this->routes[$uri][0];
            $controller->$action(mb_strtolower($httpMethod));
        } else {
            $action = 'pageNotFound';
        }


    }

}