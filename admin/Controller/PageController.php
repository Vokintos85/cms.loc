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
            'page_id' => $id,
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

    public function update()
    {
        // ДОБАВЬТЕ ОТЛАДКУ
        error_log('POST data: ' . print_r($this->request->post, true));

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['success' => false, 'error' => 'Method Not Allowed']);
            return;
        }

        $params = $this->request->post;

        // ПРОВЕРКА И ФИКСАЦИЯ page_id
        if (!isset($params['page_id']) || $params['page_id'] === 'undefined') {
            // Попробуем получить ID из другого источника или вернем ошибку
            echo json_encode(['success' => false, 'error' => 'Page ID is missing or invalid']);
            return;
        }

        // Убедимся что page_id - число
        $pageId = (int)$params['page_id'];
        if ($pageId <= 0) {
            echo json_encode(['success' => false, 'error' => 'Invalid Page ID']);
            return;
        }

        $pageModel = $this->load->model('Page');

        if (!isset($params['title']) || empty(trim($params['title']))) {
            echo json_encode(['success' => false, 'error' => 'Title is required']);
            return;
        }

        try {
            $result = $pageModel->repository->updatePage(
                $pageId, // передаем исправленный ID
                $params
            );

            echo json_encode([
                'success' => $result,
                'page_id' => $pageId,
                'message' => $result ? 'Page updated successfully' : 'Update failed'
            ]);

        } catch (\Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
