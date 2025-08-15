<?php

namespace Engine;

use Engine\Core\Request\Request;
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
    
    protected Request $request;

    /**
     * @param DI $di
     */
    public function __construct(DI $di)
    {
        $this->di      = $di;
        $this->db      = $di->get('db');
        $this->view    = $di->get('view');
        $this->config  = $di->get('config');
        $this->request = $di->get('request');
    }
}
