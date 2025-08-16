<?php

namespace Admin\Controller;

use Engine\Controller;
use Engine\Core\Auth\Auth;
use Engine\DI\DI;
use Engine\Core\Database\QueryBuilder;

class LoginController extends Controller
{
    protected Auth $auth;

    public function __construct(DI $di)
    {
        parent::__construct($di);
        $this->auth = $di->get('auth');
    }

    public function form(): void
    {
        $this->view->render('login');
    }

    public function authAdmin(): void
    {
        try {
            $params = $this->request->post;

            // Валидация
            if (empty($params['email'])) {
                throw new \Exception('Email обязателен');
            }

            if (empty($params['password'])) {
                throw new \Exception('Пароль обязателен');
            }

            // Поиск пользователя
            $user = $this->db->query(
                "SELECT * FROM `user` WHERE email = ? LIMIT 1",
                [$params['email']]
            )->fetch();

            if (!$user) {
                throw new \Exception('Пользователь не найден');
            }

            // Проверка пароля (рекомендуется использовать password_verify)
            if (!password_verify($params['password'], $user['password'])) {
                throw new \Exception('Неверный пароль');
            }

            // Обновление хеша (если нужно)
            $hash = bin2hex(random_bytes(16));
            $this->db->execute(
                "UPDATE `user` SET `hash` = ? WHERE `id` = ?",
                [$hash, $user['id']]
            );

            // Авторизация
            $this->auth->authorize($user['id']);

            // Редирект
            $this->redirect('/admin/');

        } catch (\Exception $e) {
            error_log('Auth error: ' . $e->getMessage());
            $this->redirect('/admin/login/?error=' . urlencode($e->getMessage()));
        }
    }

    protected function redirect(string $url, int $statusCode = 302): void
    {
        header('Location: ' . $url, true, $statusCode);
        exit;
    }
}