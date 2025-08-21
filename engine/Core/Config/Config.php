<?php

namespace Engine\Core\Config;

class Config
{
    /**
     *  Получить элемент из конфигурации
     *
     * @param string $key
     * @param string $group
     * @return mixed|null
     * @throws \Exception
     */
    public static function item(string $key, string $group = 'main')
    {
        $groupItems = static::file($group);

        return $groupItems[$key] ?? null;
    }

    /**
     * Получить всю группу конфигурации
     *
     * @param string $group
     * @return array
     * @throws \Exception
     */
    public static function file(string $group): array
    {
        $path = self::getConfigFilePath($group);

        if (!file_exists($path)) {
            throw new \Exception(sprintf('Config file <strong>%s</strong> not found.', $path));
        }

        $items = require_once $path;

        if (empty($items) || !is_array($items)) {
            throw new \Exception(sprintf('Config file <strong>%s</strong> is not a valid array.', $path));
        }

        return $items;
    }

    /**
     * Построить путь до файла конфигурации
     *
     * @param string $group
     * @return string
     */
    private static function getConfigFilePath(string $group): string
    {
        return $_SERVER['DOCUMENT_ROOT'] . '/' . mb_strtolower(ENV) . '/Config/' . $group . '.php';
    }
}
