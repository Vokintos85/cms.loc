<?php

namespace Cms\Controller;

use Engine\Controller;

class CmsController extends Controller
{
    /**
     * @param $di
     */
    public function __construct($di)
    {
        parent::__construct($di);
    }

    public function header()
    {
    }
}
