<?php

namespace Admin\Controller;

class ErrorController extends AdminController
{
    public function page404(): void
    {
        echo '404 Page';
    }
}
