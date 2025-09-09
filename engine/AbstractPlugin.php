<?php

namespace Engine;

use Engine\Core\Customize\Customize;
use Engine\Core\Database\Connection;
use Engine\Core\Router\Router\Router;
use Engine\DI\DI;

abstract class AbstractPlugin
{
    protected Connection $db;
    protected Router $router;
    protected Customize $customize;

    public function __construct(
        protected DI $di,
    )
    {
        $this->db = $this->di->get('db');
        $this->router = $this->di->get('router');
        $this->customize = $this->di->get('customize');
    }

    abstract public function details(): PluginDetailsDto;

    abstract public function init();
}
