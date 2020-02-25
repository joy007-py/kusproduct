<?php

namespace app\route;

class Router
{
    /**
     * @var array 
     */
    private $routes = array();

    public function add( $route, callable $callable )
    {
        $this->routes[$route] = $callable;
    }

    public function dispatch()
    {
        $path = $_SERVER['PATH_INFO'];
        if(array_key_exists($path, $this->routes)) {
            $this->routes[$path]();
        } else {
            $this->routes['/']();
        }
    }
}