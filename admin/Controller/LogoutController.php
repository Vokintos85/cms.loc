<?php

namespace Admin\Controller;

use Engine\Controller;
use Engine\Core\Auth\Auth;
use Engine\DI\DI;

class LogoutController extends Controller
{
    protected Auth $auth;
    /**
     * @param DI $di
     */
    public function __construct(DI $di)
    {
        parent::__construct($di);

        $this->auth = $di->get('auth');
    }

    public function logout()
    {
        $this->auth->unAuthorize();

        header('Location: /admin/login');
        exit;
    }
}