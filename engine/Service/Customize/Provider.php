<?php

namespace Engine\Service\Customize;

use Engine\Service\AbstractProvider;
use Engine\Core\Customize\Customize;

class Provider extends AbstractProvider
{
    public $serviceName = 'customize';

    public function init(): void
    {
        $customize = new Customize($this->di);

        $this->di->set($this->serviceName, $customize);

    }
}