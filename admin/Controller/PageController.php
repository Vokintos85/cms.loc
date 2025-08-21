<?php

namespace Admin\Controller;

class PageController extends AdminController
{
    public function listing()
    {
        $pageModel = $this->load->model('Page');

        $data['pages'] = $pageModel->repository->getPages();

        $this->view->render('pages/list', $data);
    }

    public function create()
    {
        $pageModel = $this->load->model('Page');

        $this->view->render('pages/create');
    }

    public function edit($id)
    {
        $pageModel = $this->load->model('Page');

        $pageData = $pageModel->repository->getPage($id);

        $this->view->render('pages/edit', [
            'title' => $pageData['title'],
            'content' => $pageData['content'],
        ]);
    }

    public function add()
    {
        $params    = $this->request->post;

        $pageModel = $this->load->model('Page');

        if (isset($params['title'])) {
            $pageid = $pageModel->repository->createPage($params);

            echo $pageid;
        }

        $pageModel->repository->createPage();

        print_r($params);
    }
}
