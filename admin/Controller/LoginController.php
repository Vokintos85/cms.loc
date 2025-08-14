<?php

namespace Admin\Controller;


class LoginController extends AdminController
{
    public function form(): void
    {
        $this->view->render('login');
    }
}