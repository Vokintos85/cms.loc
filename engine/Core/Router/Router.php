<?php

namespace Engine\Core\Router;

class Router
{
   private $routes = [];
   private $host;

    /**
     * @param $host
     */
   public function __construct($host)
   {
       $this->$host = $host;
   }

    /**
     * @param $key
     * @param $pattern
     * @param $controller
     * @param $method
     * @return void
     */
   public function add($key, $pattern, $controller, $method = 'GET')
   {
       $this->routes[$key] = [
               'pattern'    => $pattern,
               'controller' => $method,
               'method'     => $method,

];
   }
}