<?php

namespace Engine\Helper;

class Cookie
{
    /**
     * Add cookies
     * @param $key
     * @param $value
     * @param int $time
     */
    public static function set(
        string $key,
        string $value,
        int $expire = 0,
        string $path = '/',
        string $domain = '',
        bool $secure = false,
        bool $httponly = false
    ): bool {
        return setcookie($key, $value, [
            'expires' => $expire,
            'path' => $path,
            'domain' => $domain,
            'secure' => $secure,
            'httponly' => $httponly,
            'samesite' => 'Strict'
        ]);
    }
    public static function get($key)
    {
        if (isset($_COOKIE[$key])) {
            return $_COOKIE[$key];
        }
        return null;
    }

    /**
     * Delete cookies by key
     * @param $key
     */
    public static function delete(string $key): void
    {
        setcookie($key, '', [
            'expires'  => time() - 3600,
            'path'     => '/',
            'domain'   => '',
            'secure'   => true,
            'httponly' => true,
            'samesite' => 'Lax' // или 'Strict'
        ]);
        unset($_COOKIE[$key]); // очищаем сразу в текущем запросе
    }
}
