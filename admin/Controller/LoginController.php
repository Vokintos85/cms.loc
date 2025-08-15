<?php

namespace Admin\Controller;

use Engine\Controller;
use Engine\DI\DI;
use Engine\Core\Auth\Auth;

class LoginController extends Controller
{
    protected $auth;
    /**
     * @param DI $dI
     */
    public function __construct(DI $dI)
    {
        parent::__construct($dI);

        $this->auth = new Auth();
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function form(): void
    {
        $this->auth->authorize('sjdjsdsdsd');

        if ($this->auth->authorized())
        {
            print_r($_COOKIE);
        }

        $this->view->render('login');
    }

    /**
     * @return void
     */
    public function authAdmin(): void
    {
        try {
            $params = $this->request->post;

            // Усиленная валидация
            if (empty($params['email']) || empty($params['password'])) {
                throw new \Exception('Email и пароль обязательны');
            }

            $user = $this->db->query(
                "SELECT * FROM `user` WHERE email = ? LIMIT 1",
                [$params['email']]
            )->fetch();

            if (!$user) {
                throw new \Exception('Пользователь не найден');
            }

            // Проверка пароля (рекомендую перейти на password_hash())
            if (md5($params['password']) !== $user['password']) {
                throw new \Exception('Неверный пароль');
            }

            // Авторизация с отладкой
            $this->auth->authorize($user['id']);
            error_log('User authorized: ' . $user['id']);

            // Проверка кук
            error_log('Current cookies: ' . print_r($_COOKIE, true));

            // Редирект с гарантированным выходом
            header('Location: /admin/');
            exit;

        } catch (\Exception $e) {
            error_log('Auth error: ' . $e->getMessage());
            header('Location: /admin/login/?error=' . urlencode($e->getMessage()));
            exit;
        }
    }

    protected function redirect(string $url, int $statusCode = 302): void
    {
        header('Location: ' . $url, true, $statusCode);
        exit;
    }

}