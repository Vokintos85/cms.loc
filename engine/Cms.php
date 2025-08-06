<?php
namespace Engine;
class Cms
{
    /**
     * @var
     */
    private $di;

    public $router;

    /**
     * Cms constructor.
     * @param $di
     */
    public function __construct($di)
    {
    $this->di = $di;
    $this->router = $this->di->get('router');
    }

    /**
     * Run Cms
     */
    public function run()
    {
        $this->router->add('home', '/', 'HomeController:Index');
        $this->router->add('product', '/product/id', 'ProductController:Index');


        print_r($this->di);
    }
}