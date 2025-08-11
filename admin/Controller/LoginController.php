<?php

namespace Admin\Controller;

use Engine\Controller;

class LoginController extends Controller
{
    public function form(): void
    {
        $this->view->render('login');
    }
}