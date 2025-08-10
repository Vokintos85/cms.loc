<?php

namespace Engine;

use Engine\DI\DI;

abstract class Controller
{
    /**
     * @var DI
     */
    protected $di;

    protected $db;

    protected $view;

    /**
     * @param DI $di
     */

    public function __construct(DI $di)
    {
        $this->di = $di;
        $this->view = $di->get('view');
    }
}
