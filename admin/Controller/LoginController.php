<?php

namespace Admin\Controller;

use Engine\Controller;
use Engine\DI\DI;
use Engine\Core\Auth\Auth;

class LoginController extends Controller
{
    protected $auth;
    /**
     * @param DI $dI
     */
    public function __construct(DI $dI)
    {
        parent::__construct($dI);

        $this->auth = new Auth();
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function form(): void
    {
        print_r($_COOKIE);
        $this->view->render('login');
    }

    public function authAdmin()
    {
        $params = $this->request->post;
        print_r($params);
    }

}