<?php

namespace Engine\Core\Router;

class DispatchedRote
{
    private $controller;
    private $parametrs;

    /**
     * @param $controller
     * @param $parametrs
     */
    public function __construct($controller, $parametrs = [])
    {
        $this->controller = $controller;
        $this->parametrs = $parametrs;
    }

    /**
     * @return mixed
     */
    public function getParametrs()
    {
        return $this->parametrs;
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

}