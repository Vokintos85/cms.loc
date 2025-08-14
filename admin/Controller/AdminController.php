<?php

namespace Admin\Controller;

use Engine\Controller;
use Engine\Core\Auth\Auth;

class AdminController extends Controller
{
    protected $auth;
    /**
     * @param $di
     */
    public function __construct($di)
    {
        parent::__construct($di);

        $this->auth = new Auth();

        $this->checAutorization();
    }

    /**
     * @return void
     */
    public function checAutorization()
    {
        if (!$this->auth->authorized ()){
            // redirect
            header('Location: /admin/login', true, 301);
            exit;
        }
    }

}