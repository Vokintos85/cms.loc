<?php

namespace Engine\Service\View;

use Engine\Service\AbstractProvider;
use Engine\Core\Template\View;

class Provider extends AbstractProvider
{
    /**
     * @var string
     */

    public $serviceName = 'view';

    public function init(): void
    {
        $view = new View();

        $this->di->set($this->serviceName, $view);
    }
}
