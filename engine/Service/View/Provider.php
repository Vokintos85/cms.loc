<?php

namespace Engine\Service\View;

use Engine\Service\AbstractProvider;
use Engine\Core\Template\View;

class Provider extends AbstractProvider
{
    /**
     * @var string
     */

    public string $serviceName = 'view';

    public function init(): void
    {
        $this->di->set($this->serviceName, new View($this->di));
    }
}
