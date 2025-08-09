<?php

namespace Cms\Controller;

class ErrorController extends CmsController
{
    public function page404(): void
    {
        echo '404 Page';
    }

}