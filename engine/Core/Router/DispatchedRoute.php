<?php

namespace Engine\Core\Router;

class DispatchedRoute
{
    private mixed $controller;
    private array $parameters;

    /**
     * @param $controller
     * @param array $parameters
     */
    public function __construct($controller, array $parameters = [])
    {
        $this->controller = $controller;
        $this->parameters = $parameters;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @return mixed
     */
    public function getController(): mixed
    {
        return $this->controller;
    }
}
