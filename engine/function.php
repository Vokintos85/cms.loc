<?php

/**
 * Returns path to a Flexi CMS folder.
 *
 * @param  string $section
 * @return string
 */
function path($section)
{
    if (ENV == 'Admin') {
        $basePath = ROOT_DIR . DS . strtolower(ENV);
    } else {
        $basePath = ROOT_DIR;
    }

    switch (strtolower($section)) {
        case 'controller':
            return $basePath . DS . 'Controller';
        case 'config':
            return $basePath . DS . 'Config';
        case 'model':
            return $basePath . DS . 'Model';
        case 'view':
            return $basePath . DS . 'View';
        case 'language':
            return $basePath . DS . 'Language';
        default:
            return $basePath;
    }

}

/**
 * Returns list languages
 *
 * @return array
 */
function languages()
{
    $directory = path('language');
    $list      = scandir($directory);
    $languages = [];

    if (!empty($list)) {
        unset($list[0]);
        unset($list[1]);

        foreach ($list as $dir) {
            $pathLangDir = $directory . DS . $dir;
            $pathConfig  = $pathLangDir . '/config.json';
            if (is_dir($pathLangDir) and is_file($pathConfig)) {
                $config = file_get_contents($pathConfig);
                $info   = json_decode($config);

                $languages[] = $info;
            }
        }
    }

    return $languages;
}