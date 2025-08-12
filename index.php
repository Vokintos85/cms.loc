<?php
define('ROOT_DIR_', __DIR__);
// Подключаем автозагрузчик Composer
require __DIR__ . '/vendor/autoload.php';

define('ENV','Admin');

// Запускаем ядро приложения
require __DIR__ . '/engine/bootstrap.php';
