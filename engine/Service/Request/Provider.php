<?php

namespace Engine\Service\Request;

use Engine\Service\AbstractProvider;
use Engine\Core\Request\Request;

class Provider extends AbstractProvider
{
    public $serviceName = 'request';

    /**
     * @return void
     */
    public function init(): void
    {
        $request = new Request();

        $this->di->set($this->serviceName, $request);
    }
}

