<?php

namespace Admin\Controller;

use Engine\Controller;
use Engine\Core\Auth\Auth;
use Engine\DI\DI;

class LogoutController extends Controller
{
    /**
     * @param DI $di
     */
    public function __construct(DI $di)
    {
        parent::__construct($di);
    }

    public function logout()
    {
        // Логирование перед выходом
        $userId = $_COOKIE['auth_user'] ?? 'unknown';
        error_log("Logout initiated for user ID: $userId");

        // Полная очистка аутентификации
        $this->auth->unAuthorize();

        // Уничтожение сессии
        if (session_status() === PHP_SESSION_ACTIVE) {
            $_SESSION = [];
            session_destroy();
        }

        // Очистка кук
        setcookie('auth_user', '', time() - 3600, '/admin');
        setcookie('auth_token', '', time() - 3600, '/admin');

        // Редирект с параметром для отображения сообщения
        header('Location: /admin/login?logout=1&time=' . time());
        exit;
    }
}