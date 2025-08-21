<?php

namespace Admin\Controller;

use Engine\Controller;

class AdminController extends Controller
{
    /**
     * @param mixed $di
     */
    public function __construct($di)
    {
        parent::__construct($di);
        $this->checkAuthorization();
    }

    /**
     * Проверка авторизации администратора
     * @return void
     */
    protected function checkAuthorization()
    {
        if (!$this->auth->authorized()) {
            error_log('Unauthorized access attempt. Session: ' . json_encode($_SESSION ?? []) .
                ' | Cookies: ' . json_encode($_COOKIE ?? []));

            // 401 - Unauthorized (для API) или редирект для веба
            if ($this->isAjaxRequest()) {
                http_response_code(401);
                exit(json_encode(['error' => 'not_authorized']));
            }

            header('Location: /admin/login?error=not_authorized&from=' . urlencode($_SERVER['REQUEST_URI']));
            exit;
        }
    }

    private function isAjaxRequest(): bool
    {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
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
