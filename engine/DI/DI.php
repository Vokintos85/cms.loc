<?php

namespace Engine\DI;

use Engine\Expetion\ContainerException;

class DI
{
    /**
     * Dependency injection container storage.
     *
     * @var array<string, mixed>
     */
    private array $container = [];

    /**
     * Adds a dependency to the container.
     *
     * @param string $key The unique identifier for the dependency.
     * @param mixed $value The dependency instance or value.
     *
     * @return $this Allows method chaining.
     */
    public function set($key, $value)
    {
        $this->container[$key] = $value;

        return $this;
    }

    public function get(string $key)
    {
        return $this->container[$key] ?? throw new ContainerException("Объект $key отсутствует в контейнере.");
    }

    public function has($key): bool
    {
        return isset($this->container[$key]);
    }
}
