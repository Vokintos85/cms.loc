<?php

namespace Engine\Core\Config;

class Repository
{
    /**
     * @var array Stored config items.
     */
    protected static $stored = [];

    /**
     * Store a config group.
     *
     * @param string $group
     * @param array $data
     * @return void
     */
    public static function storeGroup(string $group, array $data): void
    {
        static::$stored[$group] = $data;
    }

    /**
     * Store a single config item.
     *
     * @param string $group
     * @param string $key
     * @param mixed $data
     * @return void
     */
    public static function store(string $group, string $key, $data): void
    {
        if (!isset(static::$stored[$group])) {
            static::$stored[$group] = [];
        }

        static::$stored[$group][$key] = $data;
    }

    /**
     * Retrieve a config item.
     *
     * @param string $group
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function retrieve(string $group, string $key, $default = null)
    {
        return static::$stored[$group][$key] ?? $default;
    }

    /**
     * Retrieve entire config group.
     *
     * @param string $group
     * @param array $default
     * @return array
     */
    public static function retrieveGroup(string $group, array $default = []): array
    {
        return static::$stored[$group] ?? $default;
    }

    /**
     * Check if config group exists.
     *
     * @param string $group
     * @return bool
     */
    public static function hasGroup(string $group): bool
    {
        return isset(static::$stored[$group]);
    }

    /**
     * Check if config item exists.
     *
     * @param string $group
     * @param string $key
     * @return bool
     */
    public static function has(string $group, string $key): bool
    {
        return isset(static::$stored[$group][$key]);
    }

    /**
     * Remove config group.
     *
     * @param string $group
     * @return void
     */
    public static function removeGroup(string $group): void
    {
        unset(static::$stored[$group]);
    }

    /**
     * Remove config item.
     *
     * @param string $group
     * @param string $key
     * @return void
     */
    public static function remove(string $group, string $key): void
    {
        unset(static::$stored[$group][$key]);
    }

    /**
     * Clear all stored config.
     *
     * @return void
     */
    public static function clear(): void
    {
        static::$stored = [];
    }

    /**
     * Get all stored config.
     *
     * @return array
     */
    public static function all(): array
    {
        return static::$stored;
    }
}