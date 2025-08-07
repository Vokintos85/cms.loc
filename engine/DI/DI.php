<?php

namespace Engine\DI;

class DI
{
    /**
     * Dependency injection container storage.
     *
     * @var array<string, mixed>
     */
    private $container = [];

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

    /**
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        return $this->has($key);
    }

    /**
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        return isset($this->container[$key]) ? $this->container [$key] : null;
    }

}