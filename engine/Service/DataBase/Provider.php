<?php

namespace Engine\Service\Database;

use Engine\Service\AbstractProvider;
use Engine\Core\Database\Connection;
use PDO;

class Provider extends AbstractProvider
{
    public $serviceName = 'db';

    public function init(): void
    {
        $config = [
            'host'     => '127.0.0.1',
            'port'     => '3306',
            'dbname'   => 'cms',
            'username' => 'cms',
            'password' => 'cms',
            'charset'  => 'utf8mb4',
            'options'  => [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4",
                // Важные параметры для MySQL 8+
                PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET SESSION sql_mode='TRADITIONAL'"
            ]
        ];

        try {
            $this->di->set($this->serviceName, new Connection($config));
        } catch (\RuntimeException $e) {
            // Обработка ошибок подключения
            die('Database connection error: ' . $e->getMessage());
        }
    }
}
