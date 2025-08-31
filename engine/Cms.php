<?php

namespace Engine;

use Engine\Core\Router\Router\Router;
use Engine\DI\DI\DI;
use Engine\Helper\Common;

class Cms
{
    /**
     * @var DI
     */
    private $di;

    /**
     * @var Router
     */
    public Router $router;

    /**
     * @var string
     */
    private string $env;

    /**
     * Cms constructor.
     * @param DI $di
     */
    public function __construct(DI $di)
    {
        $this->di = $di;
        $this->router = $this->di->get('router');
        $this->env = defined('ENV') ? ENV : 'Cms';
    }

    /**
     * Run CMS
     */
    public function run(): void
    {

        $this->loadRoutes();

        $routerDispatch = $this->router->dispatch(Common::getMethod(), Common::getPathUrl());

        if (!$routerDispatch) {
            $this->handleNotFound();
            return;
        }

        $this->dispatchController($routerDispatch);
    }

    /**
     * Load routes based on environment
     */
    private function loadRoutes(): void
    {
        $routesFile = __DIR__ . '/../' . strtolower($this->env) . '/Route.php';
        if (file_exists($routesFile)) {
            require_once $routesFile;
        } else {
            throw new \RuntimeException("Routes file not found for environment: {$this->env}");
        }
    }

    /**
     * Handle 404 Not Found
     */
    private function handleNotFound(): void
    {
        header("HTTP/1.0 404 Not Found");
        echo "404 Page Not Found";
    }

    /**
     * Dispatch controller action
     * @param mixed $routerDispatch
     */
    private function dispatchController($routerDispatch): void
    {
        list($class, $action) = explode(':', $routerDispatch->getController(), 2);

        $namespace = $this->env === 'Admin'
                ? '\\Admin\\Controller\\'
                : '\\Cms\\Controller\\';

        $controller = $namespace . $class;

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
