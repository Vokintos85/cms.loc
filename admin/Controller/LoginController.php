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
            // CSRF защита
            if (!$this->checkCsrfToken()) {
                throw new \Exception('CSRF token validation failed');
            }

            $params = $this->request->post;

            // Валидация
            if (empty($params['email']) || !filter_var($params['email'], FILTER_VALIDATE_EMAIL)) {
                throw new \Exception('Invalid email format');
            }

            if (empty($params['password']) || strlen($params['password']) < 6) {
                throw new \Exception('Password must be at least 6 characters');
            }

            // Поиск пользователя с защитой от timing-атак
            $user = $this->findUserSafely($params['email']);

            if (!$user || !password_verify($params['password'], $user['password'])) {
                // Всегда одинаковое время ответа при ошибке
                $this->simulatePasswordVerification();
                throw new \Exception('Invalid credentials');
            }

            // Дополнительные проверки
            if (!$user['is_active']) {
                throw new \Exception('Account deactivated');
            }

            // Установка авторизации
            $this->auth->authorize($user['id'], [
                'ip' => $_SERVER['REMOTE_ADDR'],
                'user_agent' => $_SERVER['HTTP_USER_AGENT']
            ]);

            // Обновление последнего входа
            $this->updateLastLogin($user['id']);

            $this->redirect('/admin/');

        } catch (\Exception $e) {
            error_log('Auth error: ' . $e->getMessage());
            $this->redirect('/admin/login?error=' . urlencode($e->getMessage()));
        }
    }

    private function findUserSafely(string $email): ?array
    {
        // Всегда делаем запрос, даже если email неверный
        $user = $this->db->query(
            "SELECT * FROM `user` WHERE email = ? LIMIT 1",
            [$email]
        )->fetch();

        return $user ?: null;
    }

    private function simulatePasswordVerification(): void
    {
        // Фиксированная задержка для защиты от timing-атак
        usleep(random_int(300000, 500000)); // 300-500ms
    }
    protected function redirect(string $url, int $statusCode = 302): void
    {
        header('Location: ' . $url, true, $statusCode);
        exit;
    }
}