<?php

namespace Engine\Service\Auth;

use Engine\Core\Auth\Auth;
use Engine\Service\AbstractProvider;

class Provider extends AbstractProvider
{
    public function init(): void
    {
        $this->di->set('auth', new Auth());
    }
}
