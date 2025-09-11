<?php

namespace Engine\Service\View\View;

use Engine\Core\Template\View;
use Engine\Service\AbstractProvider;

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
