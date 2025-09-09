<?php

namespace Engine\Service\Customize;

use Engine\Service\AbstractProvider;
use Engine\Core\Customize\Customize;

class Provider extends AbstractProvider
{
    public string $serviceName = 'customize';

    public function init(): void
    {
        $this->di->set($this->serviceName, new Customize($this->di));
    }
}