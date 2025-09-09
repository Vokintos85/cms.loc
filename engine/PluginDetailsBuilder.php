<?php

namespace Engine;

final class PluginDetailsBuilder
{
    private ?string $name = null;
    private ?string $version = null;
    private ?string $description = null;

    public static function create(): self
    {
        return new self();
    }


    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function setVersion(string $version): self
    {
        $this->version = $version;
        return $this;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }


    public function build(): PluginDetailsDto
    {
        // Быстрая валидация минимально обязательных полей
        foreach (['name' => $this->name, 'version' => $this->version, 'description' => $this->description] as $k => $v) {
            if ($v === null || $v === '') {
                throw new \InvalidArgumentException(sprintf('PluginDetails: "%s" is required', $k));
            }
        }

        return new PluginDetailsDto(
            name: $this->name,
            version: $this->version,
            description: $this->description,
        );
    }
}
