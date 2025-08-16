<?php

namespace Admin\Controller;

use Engine\Controller;
use Engine\Core\Auth\Auth;

class AdminController extends Controller
{
    protected $auth;

    /**
     * @param mixed $di
     */
    public function __construct($di)
    {
        parent::__construct($di);
        $this->auth = new Auth();
        $this->checkAuthorization();
    }

    /**
     * Проверка авторизации администратора
     * @return void
     */
    protected function checkAuthorization()
    {
        if (!$this->auth->authorized()) {
            // Логируем попытку неавторизованного доступа
            error_log('Unauthorized access attempt from IP: ' . ($_SERVER['REMOTE_ADDR'] ?? 'unknown'));

            // Редирект на страницу входа
            header('Location: /admin/login?error=not_authorized');
            exit;
        }
    }

    /**
     * Выход из системы (logout)
     * @return void
     */
    public function logout()
    {
        // Завершаем сеанс
        $this->auth->unAuthorize();

        // Очищаем сессию, если используется
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_unset();
            session_destroy();
        }

        // Логируем выход
        error_log('User logged out. ID: ' . ($_COOKIE['auth_user'] ?? 'unknown'));

        // Редирект на страницу входа с флагом выхода
        header('Location: /admin/login?logout=success');
        exit;
    }
}