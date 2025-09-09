<?php

namespace Plugin\ExamplePlugin;

use Engine\AbstractPlugin;
use Engine\PluginDetailsBuilder;
use Engine\PluginDetailsDto;

class Plugin extends AbstractPlugin
{

    public function details(): PluginDetailsDto
    {
        return PluginDetailsBuilder::create()
            ->setName('Example plugin')
            ->setDescription('Example plugin description')
            ->setVersion('1.0.0')
            ->build();
    }

    public function init()
    {
        // TODO: Implement init() method.
    }
}
