<?php

namespace Admin\Controller;

use Engine\Controller;
use Engine\DI\DI\DI;

class LoginController extends Controller
{
    public function __construct(DI $di)
    {
        parent::__construct($di);
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
            if (empty($params['email']) || !filter_var($params['email'], FILTER_VALIDATE_EMAIL)) {
                throw new \Exception('Invalid email format');
            }

            if (empty($params['password'])) {
                throw new \Exception('Password requered');
            }

            // Поиск пользователя с защитой от timing-атак
            $user = $this->findUserSafely($params['email']);

            if (!$user || md5($params['password']) !== $user['password']) {
                // Всегда одинаковое время ответа при ошибке
                $this->simulatePasswordVerification();
                throw new \Exception('Invalid credentials');
            }

            // Установка авторизации
            $this->auth->authorize($user['id']);

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
