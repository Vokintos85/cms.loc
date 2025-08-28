<?php

namespace Engine\Core\Template;

use Engine\Core\Config\Config;

class Theme
{
    private const TEMPLATE_RULES = [
            'header' => 'header-%s',
            'footer' => 'footer-%s',
            'sidebar' => 'sidebar-%s',
            'block' => 'block-%s'
    ];

    const URL_THEME_MASK = '%s/content/theme/%s';

    /**
     * @var string
     */
    protected string $themePath;
    /**
     * @var string
     */
    protected string $themeUrl;

    /**
     * @var array
     */
    protected array $data = [];
    /**
     * @var
     */
    public $asset;

    /**
     * @var
     */
    public $theme;

    public function __construct()
    {
        $this->themePath = ROOT_DIR . '/View/';
        $this->themeUrl  = '/View/';
        $this->asset     = new Asset();
    }

    public static function getUrl(): string
    {
        $currentTheme = Config::item ('defaultTheme', 'main');
        $baseUrl      = Config::item ('baseUrl', 'main');

        return sprintf(self::URL_THEME_MASK, $currentTheme);
    }

    public static function getThemePath(): string
    {
        return '';
    }


    /**
     * Load header template
     */
    public function header(string $name = ''): void
    {
        $template = $this->resolveTemplateName('header', $name);

        $this->loadTemplate($template);
    }

    /**
     * Load footer template
     */
    public function footer(string $name = ''): void
    {
        $template = $this->resolveTemplateName('footer', $name);

        $this->loadTemplate($template);
    }

    /**
     * Load sidebar template
     */
    public function sidebar(string $name = ''): void
    {
        $template = $this->resolveTemplateName('sidebar', $name);
        $this->loadTemplate($template);
    }

    /**
     * Load block template with data
     */
    public function block(string $name, array $data = []): void
    {
        $template = $this->resolveTemplateName('block', $name);
        $this->loadTemplate($template, $data);
    }

    /**
     * Resolve template name based on rules
     */
    protected function resolveTemplateName(string $type, string $name): string
    {
        if ($name === '') {
            return $type;
        }

        return sprintf(self::TEMPLATE_RULES[$type], $name);
    }

    /**
     * Safe template loader
     *
     * @throws \RuntimeException
     */
    protected function loadTemplate(string $name, array $data = []): void
    {
        $this->themePath = ROOT_DIR . '/content/themes/default/'; // TODO: берём из конфигурации

        $templateFile = $this->themePath . $name . '.php';

        $templateFile = str_replace(['//', '\\'], '/', $templateFile);

        if (!file_exists($templateFile)) {
            throw new \RuntimeException(
                sprintf('Template file "%s" does not exist', $templateFile)
            );
        }

        if (!is_readable($templateFile)) {
            throw new \RuntimeException(
                sprintf('Template file "%s" is not readable', $templateFile)
            );
        }

        try {
            extract(array_merge($this->data, $data), EXTR_SKIP);
            include $templateFile;
        } catch (\Throwable $e) {
            throw new \RuntimeException(
                sprintf('Error rendering template "%s": %s', $name, $e->getMessage()),
                $e->getCode(),
                $e
            );
        }
    }

    /**
     * Set global theme data
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }

    /**
     * Get theme asset URL
     */
    public function asset(string $path): string
    {
        return $this->themeUrl . ltrim($path, '/');
    }

    /**
     * Get theme data with support for dot notation
     *
     * @param string|array $key Key or key path (e.g. 'user.name')
     * @param mixed $default Default value if key not exists
     * @return mixed
     */
    public function getData($key, $default = null)
    {
        // Если передается массив, возможно это ошибка - вернем все данные
        if (is_array($key)) {
            return $this->data;
        }

        // Поддержка dot notation (user.name)
        $keys = explode('.', $key);
        $value = $this->data;

        foreach ($keys as $k) {
            if (!isset($value[$k])) {
                return $default;
            }
            $value = $value[$k];
        }

        return $value;
    }

    /**
     * Get all theme data
     * @return array
     */
    public function getAllData(): array
    {
        return $this->data;
    }
}
