<?php

namespace Engine\Core\Template;

use Engine\Core\Template\Theme;

class View
{
    protected $theme;

    public function __construct()
    {
        $this->theme = new Theme();
    }

    /**
     * @param $template
     * @param $vars
     * @return void
     */
    public function render($template, $vars = []): void
    {
        include_once $this->getThemePath() . '/functions.php';
        $templatePath = $this->getTemplatePath($template, ENV);

        if (!is_file($templatePath)) {
            throw new \InvalidArgumentException(
                sprintf('Template "%s" not found in "%s"', $template, $templatePath)
            );
        }
        $this->theme->setData($vars);
        extract($vars);

            ob_start();
            ob_implicit_flush();

        try {
            require $templatePath;
        } catch (\Exception $e) {
            ob_end_clean();
            throw $e;
        }

            echo ob_get_clean();
    }

    private function getTemplatePath(string $template, ?string $env = null): string
    {
        $basePath = $env === 'Cms'
            ? '/content/themes/default/'
            : '/View/';

        return ROOT_DIR . $basePath . $template . '.php';
    }

    private function getThemePath()
    {
        return ROOT_DIR . '/content/themes/default';
    }
}
