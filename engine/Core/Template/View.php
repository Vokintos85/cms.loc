<?php

namespace Engine\Core\Template;

use Engine\DI\DI;

class View
{
    protected $theme;

    protected $setting;

    protected $menu;

    public function __construct(private DI $di)
    {
        $this->theme   = new Theme('default');
        $this->setting = new Setting($di);
        $this->menu = new Menu($di);
    }

    /**
     * @param $template
     * @param array $vars
     * @return void
     */
    public function render($template, array $vars = []): void
    {
        $templatePath = $this->getTemplatePath($template, ENV);

        if (!is_file($templatePath)) {
            throw new \InvalidArgumentException(
                sprintf('Template "%s" not found in "%s"', $template, $templatePath)
            );
        }
        $this->theme->setData($vars);
        $theme = $this->theme;
        $view = $this->di->get('view');
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

    public function getTheme(): Theme
    {
        return $this->theme;
    }
}
