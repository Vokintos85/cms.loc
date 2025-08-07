<?php

namespace Engine\Core\Database;
use \PDO;
use \PDOException;

class Connection
{
    private $link;

    public function __construct()
    {
        $this->connect();
    }

    private function connect()
    {
        $config = [
                'host'     => '127.0.0.1', // Имя сервиса из docker-compose.yml
                'port'     => '3306', // Имя сервиса из docker-compose.yml
                'db_name'  => 'cms', // Из environment MYSQL_DATABASE
                'username' => 'cms', // Из environment MYSQL_USER
                'password' => 'cms', // Из environment MYSQL_PASSWORD
                'charset'  => 'utf8mb4'
        ];

        $dsn = 'mysql:host='.$config['host'].';port='.$config['port'].';dbname='.$config['db_name'].';charset='.$config['charset'];

        try {
            $this->link = new PDO($dsn, $config['username'], $config['password'], [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (PDOException $e) {
            die('Database connection failed: ' . $e->getMessage());
        }

        return $this;
    }

    public function execute($sql, $params = [])
    {
        $sth = $this->link->prepare($sql);
        return $sth->execute($params);
    }

    public function query($sql, $params = [])
    {
        $sth = $this->link->prepare($sql);
        $sth->execute($params);
        return $sth->fetchAll(PDO::FETCH_ASSOC) ?: [];
    }

    public function lastInsertId()
    {
        return $this->link->lastInsertId();
    }
}