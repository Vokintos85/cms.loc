<?php
namespace Engine\Core\Customize;

use DirectoryIterator;
use Engine\DI\DI;
use Engine\Load;
use JsonException;

/**
 * Class Customize
 * @package Flexi\Customize
 */
class Customize
{
    /**
     * @var Config
     */
    protected $config;

    /**
     * @var null|Customize
     */
    private static $instance = null;

    /**
     * Customize constructor.
     */
    public function __construct(private DI $di)
    {
        $this->config = new Config();
    }

    /**
     * @return Config
     */
    public function getConfig(): Config
    {
        return $this->config;
    }

    protected function __clone()
    {
    }

    public function getAdminMenuItems(): array
    {
        return $this->getConfig()->get('dashboardMenu');
    }

    /**
     * @return mixed|null
     */
    public function getAdminSettingItems()
    {
        return $this->getConfig()->get('settingMenu');
    }

    public function getThemes(): array
    {
        // При необходимости поправьте базовый путь
        $base = rtrim(ROOT_DIR . '/../content/themes', '/\\');

        if (!is_dir($base)) {
            return []; // или бросить исключение — решайте по вашему коду
        }

        $themes = [];

        foreach (new DirectoryIterator($base) as $dir) {
            if (!$dir->isDir() || $dir->isDot()) {
                continue;
            }

            $slug = $dir->getFilename();
            $themeDir  = $dir->getPathname();
            $themeFile = $themeDir . DIRECTORY_SEPARATOR . 'theme.json';

            if (!is_file($themeFile)) {
                continue; // у темы нет manifest — пропускаем
            }

            try {
                $raw = file_get_contents($themeFile);

                if ($raw === false) {
                    continue;
                }

                $meta = json_decode($raw, true, 512, JSON_THROW_ON_ERROR);

                // Валидация обязательных полей
                $required = ['name','version','title','description'];

                foreach ($required as $key) {
                    if (!array_key_exists($key, $meta)) {
                        // можно логировать, а можно бросать исключение
                        continue 2; // пропустить всю тему
                    }
                }

                // Нормализация необязательных полей
                $meta['parent'] = $meta['parent'] ?? null;

                $themes[$slug] = [
                    'slug' => $slug,
                    'preview' => sprintf('/content/themes/%s/preview.png', $dir),
                    'dir'  => $themeDir,
                    'file' => $themeFile,
                    'meta' => $meta,
                ];
            } catch (JsonException $e) {
                // theme.json битый — можно залогировать и пропустить
                continue;
            }
        }

        // Опционально: сортировка по названию темы
        uasort($themes, static function ($a, $b) {
            return strcasecmp($a['meta']['title'], $b['meta']['title']);
        });

        return $themes;
    }

}