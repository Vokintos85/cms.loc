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

    protected array $config;
    
    protected  $request;

    /**
     * @param DI $di
     */
    public function __construct(DI $di)
    {
        $this->di      = $di;
        $this->view    = $di->get('view');
        $this->config  = $di->get('config');
        $this->request = $di->get('request');
    }
}
