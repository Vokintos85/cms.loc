<?php
namespace Engine;

use Engine\Helper\Common;

class Cms
{
    /**
     * @var
     */
    private $di;

    public $router;

    /**
     * cms constructor.
     * @param $di
     */
    public function __construct($di)
    {
    $this->di = $di;
    $this->router = $this->di->get('router');
    }

    /**
     * Run cms
     */
    public function run()
    {
        $this->router->add('home', '/', 'HomeController:Index');
        $this->router->add('product', '/user/12', 'ProductController:Index');

        $routerDispatch = $this->router->dispatch(Common::getMethod(), Common::getPatchUrl());
        //print_r($this->di);

        //print_r($_SERVER);
        print_r($routerDispatch);

    }
}