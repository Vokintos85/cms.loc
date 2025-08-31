<?php

namespace Engine\Core\Template;

use Engine\Core\Config\Config;

class Theme
{
    public const TEMPLATE_RULES = [
        'header'  => 'header%s',      // 'header' или 'header-%s' (ниже логика с тире)
        'footer'  => 'footer%s',
        'sidebar' => 'sidebar%s',
        'block'   => 'block-%s',      // для блоков всегда требуем имя
    ];

    private const THEMES_DIR = ROOT_DIR . '/content/themes';
    private const CORE_FALLBACK_DIR = ROOT_DIR . '/View'; // старые шаблоны системы

    /** @var string Имя активной темы */
    private string $themeName;

    /** @var array<string,string> Кэш найденных путей шаблонов */
    private static array $templateCache = [];

    /** @var array Глобальные данные */
    protected array $data = [];

    /** @var array<string,string> Кэш манифестов ассетов по теме */
    private static array $assetManifestCache = [];

    public function __construct(?string $themeName = null)
    {
        $this->themeName = $themeName ?: self::getTheme();
    }

    /** Смена темы на лету (например, по домену/тенанту) */
    public function setTheme(string $name): void
    {
        $this->themeName = $name;
    }

    /** Текущая тема */
    public function getThemeName(): string
    {
        return $this->themeName;
    }

    /** URL базового каталога текущей темы (папка public) */
    public function getUrl(): string
    {
        return '/content/themes/' . $this->themeName;
    }

    /**
     * @return void
     */
    public static function title()
    {
        $nameSite    = Setting::get('name_site');
        $description = Setting::get('description');

        echo $nameSite . ' | ' . $description;
    }

    /** URL ассета с учётом manifest.json и версионирования */
    public function asset(string $assetPath): string
    {
        $assetPath = ltrim($assetPath, '/');

        // Попытка через manifest.json (для Vite/Webpack)
        $fromManifest = $this->resolveAssetFromManifest($assetPath);

        if ($fromManifest !== null) {
            return $fromManifest;
        }

        // Иначе: /content/themes/<theme>/public/<file>?v=<themeVersion>
        $meta = ThemeRegistry::get($this->themeName) ?? ['url' => '/content/themes/'.$this->themeName, 'version' => null];
        $base = rtrim($meta['url'], '/') . '/public/' . $assetPath;

        return $base . $this->versionSuffix($meta['version']);
    }

    private function versionSuffix(?string $version): string
    {
        if ($version) {
            return '?v=' . rawurlencode($version);
        }
        // dev-помощь: при отсутствии версии — инвалидируем по mtime файла, если доступен
        $fsPath = self::THEMES_DIR . '/' . $this->themeName . '/public/' . ltrim(parse_url($version ?? '', PHP_URL_PATH) ?? '', '/');
        return is_file($fsPath) ? ('?t=' . filemtime($fsPath)) : '';
    }

    private function resolveAssetFromManifest(string $assetPath): ?string
    {
        $manifestPath = self::THEMES_DIR . '/' . $this->themeName . '/public/manifest.json';
        if (!isset(self::$assetManifestCache[$this->themeName])) {
            self::$assetManifestCache[$this->themeName] = is_file($manifestPath)
                ? (string)file_get_contents($manifestPath)
                : '';
        }

        if (self::$assetManifestCache[$this->themeName] === '') {
            return null;
        }

        $map = json_decode(self::$assetManifestCache[$this->themeName], true);
        if (!is_array($map)) {
            return null;
        }

        // Vite/webpack могут иметь разные форматы; поддержим два варианта:
        // 1) { "app.css": "app.123.css", ... }
        // 2) { "app.css": { "file": "app.123.css" }, ... }
        $entry = $map[$assetPath] ?? null;
        if (!$entry) return null;

        $file = is_array($entry) ? ($entry['file'] ?? null) : $entry;
        if (!$file) return null;

        $meta = ThemeRegistry::get($this->themeName) ?? ['url' => '/content/themes/'.$this->themeName, 'version' => null];
        $url  = rtrim($meta['url'], '/') . '/public/' . ltrim($file, '/');

        return $url . $this->versionSuffix($meta['version']);
    }

    /** ===== ВЫВОД ШАБЛОНОВ ===== */

    public function header(string $name = ''): void
    {
        $template = $this->resolveTemplateName('header', $name);

        $this->loadTemplate($template);
    }

    public function footer(string $name = ''): void
    {
        $template = $this->resolveTemplateName('footer', $name);
        $this->loadTemplate($template);
    }

    public function sidebar(string $name = ''): void
    {
        $template = $this->resolveTemplateName('sidebar', $name);
        $this->loadTemplate($template);
    }

    public function block(string $name, array $data = []): void
    {
        if ($name === '') {
            throw new \InvalidArgumentException('Block name must not be empty.');
        }
        $template = $this->resolveTemplateName('block', $name);
        $this->loadTemplate($template, $data);
    }

    /** Рендер произвольного шаблона (например, 'partials/menu') */
    public function template(string $relative, array $data = []): void
    {
        $this->loadTemplate($relative, $data, true);
    }

    /** Правила формирования имени */
    protected function resolveTemplateName(string $type, string $name): string
    {
        if ($type === 'block') {
            // строго block-<name>
            return sprintf(self::TEMPLATE_RULES['block'], $name);
        }

        // header / footer / sidebar: если имя не задано — просто base, иначе base-<name>
        if ($name === '') {
            return str_replace('%s', '', self::TEMPLATE_RULES[$type]); // header%s -> header
        }
        $pattern = self::TEMPLATE_RULES[$type];
        // чтобы 'header%s' стало 'header-foo'
        if ($pattern === 'header%s' || $pattern === 'footer%s' || $pattern === 'sidebar%s') {
            return str_replace('%s', '-' . $name, $pattern);
        }

        return sprintf($pattern, $name);
    }

    /**
     * Безопасный лоадер шаблона с каскадным поиском:
     *  1) текущая тема (/templates)
     *  2) родительская тема (/templates)
     *  3) системный фолбэк (CORE_FALLBACK_DIR)
     */
    protected function loadTemplate(string $relative, array $data = [], bool $isRawPath = false): void
    {
        $relative = ltrim($relative, '/');

        if (!$isRawPath && !str_ends_with($relative, '.php')) {
            $relative .= '.php';
        }

        $cacheKey = $this->themeName . '::' . $relative;
        $file = self::$templateCache[$cacheKey] ?? null;

        if (!$file) {
            $file = $this->findTemplate($relative, $isRawPath);
            self::$templateCache[$cacheKey] = $file;
        }

//        if (!is_file($file) || !is_readable($file)) {
//            throw new \RuntimeException(sprintf('Template "%s" not found or not readable (resolved: %s)', $relative, $file));
//        }

        try {
            extract(array_merge($this->data, $data), EXTR_SKIP);
            include '/' . $file;
        } catch (\Throwable $e) {
            throw new \RuntimeException(
                sprintf('Error rendering template "%s": %s', $relative, $e->getMessage()),
                (int)$e->getCode(),
                $e
            );
        }
    }

    /** Возвращает первый существующий путь шаблона по цепочке наследования */
    private function findTemplate(string $relative, bool $isRawPath): string
    {
        $paths = [];

        // 1) child (текущая)
        $child = ThemeRegistry::get($this->themeName);
        if ($child) {
            $paths[] = $this->safeJoin($child['path'], $isRawPath ? '' : 'templates', $relative);

            // 2) parent
            if (!empty($child['parent'])) {
                $parent = ThemeRegistry::get($child['parent']);
                if ($parent) {
                    $paths[] = $this->safeJoin($parent['path'], $isRawPath ? '' : 'templates', $relative);
                }
            }
        }

        // 3) системный фолбэк (старые шаблоны)
        $paths[] = $this->safeJoin(self::CORE_FALLBACK_DIR, '', $relative);

        foreach ($paths as $p) {
            if (is_file($p)) return $p;
        }

        // Вернём то, что ближе к ожидаемому (для диагностик)
        return $paths[0] ?? $this->safeJoin(self::CORE_FALLBACK_DIR, '', $relative);
    }

    /** Безопасная склейка путей без выхода наружу темы */
    private function safeJoin(string ...$parts): string
    {
        $path = implode('/', array_map(fn($p) => trim($p, '/'), $parts));
        $path = str_replace(['..\\', '../', '\\..', '/..'], '', $path); // грубая защита от traversal
        $path = str_replace(['//', '\\'], '/', $path);
        return $path;
    }

    /** ===== Глобальные данные темы ===== */

    public function setData(array $data): void
    {
        $this->data = $data;
    }

    /**
     * Получение данных с dot-нотацией: user.name
     * @param string|array $key
     */
    public function getData($key, $default = null)
    {
        if (is_array($key)) {
            return $this->data;
        }
        $keys  = explode('.', (string)$key);
        $value = $this->data;

        foreach ($keys as $k) {
            if (!is_array($value) || !array_key_exists($k, $value)) {
                return $default;
            }
            $value = $value[$k];
        }
        return $value;
    }

    public function getAllData(): array
    {
        return $this->data;
    }

    /** ===== Статика совместимости (Config) ===== */

    public static function getThemePath(): string
    {
        return self::THEMES_DIR . '/' . self::getTheme();
    }

    public static function getTheme(): string
    {
        return (string) Config::item('defaultTheme', 'main');
    }
}
