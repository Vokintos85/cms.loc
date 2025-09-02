<?php
// Engine/Core/Template/ViewHelper.php

namespace Engine\Core\Template;

class ViewHelper
{
    /** @var View */
    private static $instance;

    public static function setView(View $view): void
    {
        self::$instance = $view;
    }

    public static function setting(string $key, $default = null)
    {
        if (!self::$instance) {
            return $default;
        }

        return self::$instance->getSetting($key, $default);
    }

    public static function theme(): ?Theme
    {
        if (!self::$instance) {
            return null;
        }

        return self::$instance->getTheme();
    }
}
