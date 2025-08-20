<?php

namespace Engine\Core\Database;

use PDO;
use PDOException;

class Connection
{
    private PDO $pdo;

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
                $config['options'] ?? [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
            );

        } catch (PDOException $e) {
            throw new \RuntimeException(sprintf(
                'DB Connection Error: %s [%s@%s]',
                $e->getMessage(),
                $config['username'],
                $config['host']
            ));
        }
    }

    /**
     * Выполнение запроса (INSERT, UPDATE, DELETE)
     */
    public function execute(string $sql, array $params = []): int
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->rowCount();
    }

    /**
     * Выполнение запроса с возвратом данных (SELECT)
     */
    public function query(string $sql, array $params = []): false|\PDOStatement
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt;
    }

    /**
     * Получение ID последней вставленной записи
     */
    public function lastInsertId(): string
    {
        return $this->pdo->lastInsertId();
    }
}