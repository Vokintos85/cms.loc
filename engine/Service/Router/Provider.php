<?php

namespace Engine\Service\Router;

use Engine\Service\AbstractProvider;
use Engine\Core\Router\Router;

class Provider extends AbstractProvider
{
    /**
     * @var string
     */

    public $serviceName = 'router';

    public  function init(): void
    {
        $router = new Router('');

        $this->di->set($this->serviceName, $router);
    }
}