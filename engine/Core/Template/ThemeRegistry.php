<?php

namespace Engine\Core\Template;

final class ThemeRegistry
{
    private const string THEMES_DIR = ROOT_DIR . '/content/themes';
    private static array $cache = [];

    /**
     * @return array<string, array> Ключ — имя темы, значение — метаданные
     */
    public static function all(): array
    {
        if (self::$cache) {
            return self::$cache;
        }

        $entries = @scandir(self::THEMES_DIR) ?: [];
        foreach ($entries as $entry) {
            if ($entry === '.' || $entry === '..') continue;
            $path = self::THEMES_DIR . '/' . $entry;
            if (!is_dir($path)) continue;

            $meta = [
                'name'    => $entry,
                'parent'  => null,
                'version' => null,
                'path'    => $path,
                'url'     => '/content/themes/' . $entry,
            ];

            $manifest = $path . '/theme.json';
            if (is_file($manifest)) {
                $data = json_decode((string)file_get_contents($manifest), true) ?: [];
                $meta['name']    = $data['name']    ?? $entry;
                $meta['parent']  = $data['parent']  ?? null;
                $meta['version'] = $data['version'] ?? null;
            }

            self::$cache[$meta['name']] = $meta;
        }

        return self::$cache;
    }

    public static function get(string $name): ?array
    {
        $all = self::all();
        return $all[$name] ?? null;
    }

    public static function exists(string $name): bool
    {
        return self::get($name) !== null;
    }
}