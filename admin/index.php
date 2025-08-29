<?php

define('ROOT_DIR', __DIR__);
// Подключаем автозагрузчик Composer
require __DIR__ . '/../vendor/autoload.php';

define('ENV', 'Admin');
define('DS', DIRECTORY_SEPARATOR );

// Запускаем ядро приложения
require __DIR__ . '/../engine/bootstrap.php';
