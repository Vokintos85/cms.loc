<?php

namespace Engine\Core\Auth;

use Engine\Helper\Cookie;

class Auth implements AuthInterface
{
    protected $authorized = false;
    protected $user = null;

    /**
     * Проверяет, авторизован ли пользователь
     */
    public function authorized(): bool
    {
        if (!$this->authorized) {
            $this->authorized = Cookie::get('auth_authorized') === '1';

            if ($this->authorized) {
                $userId = Cookie::get('auth_user');
                if ($userId) {
                    $this->user = $this->getUserById($userId);
                }
            }
        }

        return $this->authorized;
    }

    /**
     * Возвращает текущего пользователя
     */
    public function user()
    {
        if (!$this->authorized()) {
            return null;
        }

        return $this->user;
    }

    /**
     * Авторизует пользователя
     */
    public function authorize($userId): void
    {
        // Устанавливаем защищенные куки
        Cookie::set('auth_authorized', '1', 0, '/', '', true, true);
        Cookie::set('auth_user', (string)$userId, 0, '/', '', true, true);

    }

    /**
     * Завершает сеанс пользователя
     */
    public function unAuthorize(): void
    {
        Cookie::delete('auth_authorized');
        Cookie::delete('auth_user');

    }

    /**
     * Генерирует соль для пароля
     */
    public static function salt(): string
    {
        return bin2hex(random_bytes(16)); // Более безопасная генерация
    }

    /**
     * Шифрует пароль
     */
    public static function encryptPassword(string $password, string $salt = ''): string
    {
        return hash('sha256', $password . $salt);
    }

    /**
     * Получает пользователя по ID (заглушка - реализуйте согласно вашей БД)
     */
    protected function getUserById($userId)
    {
        // Здесь должна быть реализация получения пользователя из БД
        // Например:
        // return $this->db->query("SELECT * FROM users WHERE id = ?", [$userId])->fetch();
        return ['id' => $userId]; // временная заглушка
    }
}