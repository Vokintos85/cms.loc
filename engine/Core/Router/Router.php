<?php

namespace Engine\Core\Router;

class Router
{
   private $routes = [];
   private $dispatcher;
   private $host;

    /**
     * @param $host
     */
   public function __construct($host)
   {
       $this->$host = $host;
   }

   public function add($key, $pattern, $controller, $method = 'GET'): void
   {
       $this->routes[$key] = [
               'pattern'    => $pattern,
               'controller' => $method,
               'method'     => $method

       ];
   }

    public function dispatch($method, $uri): ?DispatchedRoute
    {
        return $this->getDispatcher()->dispatch($method, $uri);
    }

    public function getDispatcher()
    {
        if ($this->dispatcher == null)
        {
            $this->dispatcher = new UrlDispatcher();

            foreach ($this->routes as $route)
            {
                $this->dispatcher->register($route['method'], $route['pattern'], $route['controller']);
            }
        }

        return $this->dispatcher;
    }
}

