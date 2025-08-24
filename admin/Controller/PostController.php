<?php

namespace Admin\Controller;

class PostController extends AdminController
{
    public function listing()
    {
        $postModel = $this->load->model('Post');

        $data['posts'] = $postModel->repository->getPosts();

        $this->view->render('posts/list', $data);
    }

    public function create()
    {
        $this->view->render('posts/create');
    }

    public function edit($id)
    {
        $postModel = $this->load->model('Post');

        $postData = $postModel->repository->getPost($id);

        $this->view->render('posts/edit', [
            'post_id' => $id,
            'title' => $postData['title'],
            'content' => $postData['content'],
        ]);
    }

    public function add()
    {
        $params = $this->request->post;

        $postModel = $this->load->model('Post');

        // Проверяем, есть ли данные для создания поста
        if (isset($params['title']) && !empty($params['title'])) {
            try {
                $postid = $postModel->repository->createPost($params);
                echo $postid;
                // Здесь обычно делаем редирект или возвращаем JSON ответ
            } catch (\Exception $e) {
                // Обработка ошибки
                echo "Error: " . $e->getMessage();
            }
        } else {
            // Если это GET запрос или форма не отправлена, показываем форму
            $this->view->render('posts/create'); // Исправил на posts/create
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

        // ПРОВЕРКА И ФИКСАЦИЯ post_id
        if (!isset($params['post_id']) || $params['post_id'] === 'undefined') {
            // Попробуем получить ID из другого источника или вернем ошибку
            echo json_encode(['success' => false, 'error' => 'Post ID is missing or invalid']);
            return;
        }

        // Убедимся что post_id - число
        $postId = (int)$params['post_id'];
        if ($postId <= 0) {
            echo json_encode(['success' => false, 'error' => 'Invalid Post ID']);
            return;
        }

        $postModel = $this->load->model('Post');

        if (!isset($params['title']) || empty(trim($params['title']))) {
            echo json_encode(['success' => false, 'error' => 'Title is required']);
            return;
        }

        try {
            $result = $postModel->repository->updatePost(
                $postId, // передаем исправленный ID
                $params
            );

            echo json_encode([
                'success' => $result,
                'post_id' => $postId,
                'message' => $result ? 'Post updated successfully' : 'Update failed'
            ]);

        } catch (\Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}