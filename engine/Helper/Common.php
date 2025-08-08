<?php

namespace Engine\Helper;

class Common
{
    /**
     * Проверяет, является ли запрос POST.
     * @return bool
     */
    public function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    /**
     * Возвращает метод HTTP-запроса (GET, POST, etc.).
     * @return string
     */
    public static function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * @return false|int
     */
    public static function getPatchUrl()
    {
        $patchUrl = $_SERVER['REQUEST_URI']; // Получаем полный URL

        // Если есть параметры (знак ?), обрезаем их
        if ($position = strpos($patchUrl, '?')) {
            $patchUrl = substr($patchUrl, 0, $position);
        }

        return $patchUrl; // ← Возвращаем обработанный URL
    }
}