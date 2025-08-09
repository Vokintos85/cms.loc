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
        $this->router->add('home', '/', 'HomeController:index'); // исправлен регистр
        $this->router->add('news', '/news', 'HomeController:news');
        $this->router->add('news_single', '/news/(id:int)', 'HomeController:news');

        $routerDispatch = $this->router->dispatch(Common::getMethod(), Common::getPathUrl());

        if (!$routerDispatch) {
            header("HTTP/1.0 404 Not Found");
            echo "404 Page Not Found";
            return;
        }

        list($class, $action) = explode(':', $routerDispatch->getController(), 2);
        $controller = '\\Cms\\Controller\\' . $class;

        if (!class_exists($controller)) {
            throw new \RuntimeException("Controller {$controller} not found");
        }

        if (!method_exists($controller, $action)) {
            throw new \RuntimeException("Method {$action} not found in {$controller}");
        }

        call_user_func_array(
                [new $controller($this->di), $action],
                $routerDispatch->getParameters()
        );
    }
}