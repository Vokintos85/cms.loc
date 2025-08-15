<?php

namespace Engine\Core\Database;

use PDO;
use PDOException;

class Connection
{
    private $pdo;

    public function __construct(array $config)
    {
        if (empty($config['host'])) {
            throw new \InvalidArgumentException('Database host not configured');
        }

        try {
            $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset={$config['charset']}";

            $this->pdo = new PDO(
                $dsn,
                $config['username'],
                $config['password'],
                $config['options'] ?? []
            );

            // Тестовый запрос для проверки
            $this->pdo->query('SELECT 1')->execute();

        } catch (PDOException $e) {
            throw new \RuntimeException(sprintf(
                'DB Connection Error: %s [%s@%s]',
                $e->getMessage(),
                $config['username'],
                $config['host']
            ));
        }
    }

    public function query(string $sql, array $params = [])
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}