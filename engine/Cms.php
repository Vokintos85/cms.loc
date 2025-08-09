<?php

namespace Engine;

use Engine\Core\Router\Router;

use Engine\DI\DI;
use Engine\Helper\Common;

class Cms
{
    /**
     * @var
     */
    private $di;

    public Router $router;

    /**
     * cms constructor.
     * @param DI $di
     */
    public function __construct(DI $di)
    {
        $this->di = $di;
        $this->router = $this->di->get('router');
    }

    /**
     * Run cms
     */
    public function run(): void
    {
        $this->router->add('home', '/', 'HomeController:Index');
        $this->router->add('news', '/news', 'HomeController:news');

        $routerDispatch = $this->router->dispatch(Common::getMethod(), Common::getPathUrl());

        list($class, $action) = explode(':', $routerDispatch->getController(), 2);

        $controller = '\\Cms\\Controller\\' .  $class;
        call_user_func_array([new $controller($this->di), $action], $routerDispatch->getParameters());

        //print_r($_SERVER);
       // print_r($routerDispatch);

    }
}