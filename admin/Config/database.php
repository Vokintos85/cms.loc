<?php



return [
    'host'     => '127.0.0.1',  // или 'mysql' если используете docker-compose
    'port'     => '3306',
    'dbname'   => 'cms',        // Совпадает с MYSQL_DATABASE
    'username' => 'dcms',       // Совпадает с MYSQL_USER
    'password' => 'cms',        // Совпадает с MYSQL_PASSWORD
    'charset'  => 'utf8mb4',
    'options'  => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_TIMEOUT => 5,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
    ]
];