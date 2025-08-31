<?php

namespace Engine\Service;

use Engine\DI\DI\DI;

abstract class AbstractProvider
{
    protected DI $di;

    public function __construct(DI $di)
    {
        $this->di = $di;
    }

    abstract public function init(): void;
}
