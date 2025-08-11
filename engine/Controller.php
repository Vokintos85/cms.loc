<?php

namespace Engine;

use Engine\Core\Template\View;
use Engine\DI\DI;

abstract class Controller
{
    /**
     * @var DI
     */
    protected $di;

    protected $db;

    protected View $view;

    /**
     * @param DI $di
     */

    public function __construct(DI $di)
    {
        $this->di = $di;
        $this->view = $di->get('view');
    }
}
