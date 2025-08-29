<?php

namespace Engine\Core\Template;

class Asset
{
    const JS_SCRIPT_MASK = '<script src="%s"></script>';
    const CSS_LINK_MASK = '<link rel="stylesheet" href="%s">';
    const JS_LINK_MASK = '<script src="%s"></script>';
    const EXT_CSS = '.css';
    const EXT_JS = '.js';
    /**
     * @var array
     */
    public static $container = [];

    /**
     * @param string $link
     */
    public static function css($link)
    {
        $file = Theme::getThemePath() . DS . $link . self::EXT_CSS;
        if (is_file($file)) {
            self::$container['css'][] = [
                'file' => Theme::getUrl() . '/' . $link . self::EXT_CSS
            ];
        }
    }

    /**
     * @param string $link
     */
    public static function js($link)
    {
        $file = Theme::getThemePath() . DS . $link . self::EXT_JS;

        if (is_file($file)) {
            self::$container['js'][] = [
                'file' => Theme::getUrl() . '/' . $link . self::EXT_JS
            ];
        }
    }

    /**
     * @param string $extension
     */
    public static function render($extension)
    {
        $listAssets = isset(self::$container[$extension]) ? self::$container[$extension] : false;

        if ($listAssets) {
            $renderMethod = 'render' . ucfirst($extension);

            self::$renderMethod($listAssets);
        }
    }

    /**
     * @param array $list
     */
    public static function renderJs($list)
    {
        foreach ($list as $item) {
            echo sprintf(
                self::JS_SCRIPT_MASK,
                $item['file']
            );
        }
    }

    /**
     * @param array $list
     */
    public static function renderCss($list)
    {
        foreach ($list as $item) {
            echo sprintf(
                self::CSS_LINK_MASK,
                $item['file']
            );
        }
    }
}