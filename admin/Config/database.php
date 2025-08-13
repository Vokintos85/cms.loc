<?php

return[
    'host'     => '127.0.0.1', // Имя сервиса из docker-compose.yml
    'port'     => '3306', // Имя сервиса из docker-compose.yml
    'db_name'  => 'cms', // Из environment MYSQL_DATABASE
    'username' => 'cms', // Из environment MYSQL_USER
    'password' => 'cms', // Из environment MYSQL_PASSWORD
    'charset'  => 'utf8mb4'
];