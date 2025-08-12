<?php

namespace Engine\Service\Config;

use Engine\Core\Config\Config;
use Engine\Service\AbstractProvider;

class Provider extends AbstractProvider
{
    /**
     * @var string
     */
    public $serviceName = 'config';

    public function init(): void
    {
        $config = [
            'main' => Config::file('main'),
            'database' => Config::file('database')
        ];

        $this->di->set($this->serviceName, $config);
    }
}