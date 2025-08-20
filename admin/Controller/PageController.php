<?php

namespace Admin\Controller;

class PageController extends AdminController
{
    public function listing()
    {
        $pagemodel = $this->load->model('Page');

        $data['pages'] = $pagemodel->reposytory->getPages();

        $this->view->render('pages/list');
    }

    public function create()
    {
        $pagemodel = $this->load->model('Page');

        $this->view->render('pages/create');
    }
}