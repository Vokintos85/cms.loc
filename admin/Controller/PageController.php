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
        $params = $this->request->post;

        $pageModel = $this->load->model('Page');

        // Проверяем, есть ли данные для создания страницы
        if (isset($params['title']) && !empty($params['title'])) {
            try {
                $pageid = $pageModel->repository->createPage($params);
                echo $pageid;
                // Здесь обычно делаем редирект или возвращаем JSON ответ
            } catch (\Exception $e) {
                // Обработка ошибки
                echo "Error: " . $e->getMessage();
            }
        } else {
            // Если это GET запрос или форма не отправлена, показываем форму
            $this->view->render('pages/create'); // Исправил на pages/create
        }
    }
}
