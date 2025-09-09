<?php

namespace Engine;

final class PluginDetailsDto implements \JsonSerializable
{
    public function __construct(
        public readonly string $name,
        public readonly string $version,
        public readonly string $description,

    ) {}

    public function jsonSerialize(): array
    {
        return [
            'name'          => $this->name,
            'version'       => $this->version,
            'description'   => $this->description,
        ];
    }
}
