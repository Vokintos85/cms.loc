<?php

declare(strict_types=1);

namespace Engine\Core\Database;

class QueryBuilder
{
    /** @var array<string, mixed> */
    protected array $sql = [];

    /** @var list<mixed> */
    public array $values = [];

    public function select(string $fields = '*'): static
    {
        $this->reset();
        $this->sql['select'] = "SELECT {$fields} ";
        return $this;
    }

    public function delete(): static
    {
        $this->reset();
        $this->sql['delete'] = "DELETE ";
        return $this;
    }

    public function from(string $table): static
    {
        $this->sql['from'] = "FROM {$table} ";
        return $this;
    }

    public function where(string $column, string $value, string $operator = '='): static
    {
        // Простая защита от мусора в операторе
        $safeOperator = in_array($operator, ['=', '!=', '<>', '>', '>=', '<', '<=', 'LIKE', 'ILIKE', 'IN', 'NOT IN'], true)
            ? $operator
            : '=';

        if (!isset($this->sql['where'])) {
            $this->sql['where'] = [];
        }

        // Для IN/NOT IN поддержим CSV в value: "a,b,c" -> (?, ?, ?)
        if (($safeOperator === 'IN' || $safeOperator === 'NOT IN') && str_contains($value, ',')) {
            $parts = array_map('trim', explode(',', $value));
            $placeholders = implode(', ', array_fill(0, count($parts), '?'));
            $this->sql['where'][] = sprintf('%s %s (%s)', $column, $safeOperator, $placeholders);
            foreach ($parts as $p) {
                $this->values[] = $p;
            }
        } else {
            $this->sql['where'][] = sprintf('%s %s ?', $column, $safeOperator);
            $this->values[] = $value;
        }

        return $this;
    }

    public function orderBy(string $field, string $order): static
    {
        $ord = strtoupper($order) === 'DESC' ? 'DESC' : 'ASC';
        $this->sql['order_by'] = "ORDER BY {$field} {$ord}";
        return $this;
    }

    public function limit(int $number): static
    {
        $n = max(0, $number);
        $this->sql['limit'] = " LIMIT {$n}";
        return $this;
    }

    public function update(string $table): static
    {
        $this->reset();
        $this->sql['update'] = "UPDATE {$table} ";
        return $this;
    }

    public function insert(string $table): static
    {
        $this->reset();
        $this->sql['insert'] = "INSERT INTO {$table} ";
        return $this;
    }

    public function set(array $data = []): static
    {
        // Не используем ".=" — инициализируем ключ детерминированно
        $this->sql['set'] = 'SET ';

        if (!empty($data)) {
            $pairs = [];
            foreach ($data as $key => $value) {
                $pairs[] = sprintf('%s = ?', (string)$key);
                $this->values[] = $value;
            }
            $this->sql['set'] .= implode(', ', $pairs);
        }

        return $this;
    }

    /**
     * Собирает SQL и ИНЛАЙНИТ значения вместо плейсхолдеров.
     * Семантика метода сохранена (без аргументов, возвращает строку SQL).
     */
    public function sql(): string
    {
        $parts = [];

        if (isset($this->sql['select'])) { $parts[] = $this->sql['select']; }
        if (isset($this->sql['delete'])) { $parts[] = $this->sql['delete']; }
        if (isset($this->sql['insert'])) { $parts[] = $this->sql['insert']; }
        if (isset($this->sql['update'])) { $parts[] = $this->sql['update']; }
        if (isset($this->sql['set']))    { $parts[] = $this->sql['set']; }
        if (isset($this->sql['from']))   { $parts[] = $this->sql['from']; }

        if (!empty($this->sql['where']) && is_array($this->sql['where'])) {
            $parts[] = 'WHERE ' . implode(' AND ', $this->sql['where']);
        }

        if (isset($this->sql['order_by'])) { $parts[] = $this->sql['order_by']; }
        if (isset($this->sql['limit']))    { $parts[] = $this->sql['limit']; }

        $withPlaceholders = trim(implode(' ', array_map('trim', $parts)));

        if ($withPlaceholders === '') {
            return '';
        }

        // Инлайним значения вместо `?`
        $i = 0;
        $final = preg_replace_callback('/\?/', function () use (&$i) {
            $value = $this->values[$i] ?? null;
            $i++;
            return $this->quoteValue($value);
        }, $withPlaceholders) ?? $withPlaceholders;

        return $final;
    }

    /** Reset Builder */
    public function reset(): void
    {
        $this->sql = [];
        $this->values = [];
    }

    /**
     * Примитивное экранирование значений для инлайна.
     * Производственный код должен использовать подготовленные выражения драйвера.
     */
    protected function quoteValue(mixed $value): string
    {
        if ($value === null) {
            return 'NULL';
        }
        if (is_bool($value)) {
            return $value ? 'TRUE' : 'FALSE';
        }
        if (is_int($value) || is_float($value)) {
            // Числа оставляем как есть
            return (string)$value;
        }
        // Строки — экранируем одинарные кавычки
        $escaped = str_replace("'", "''", (string)$value);
        return "'{$escaped}'";
    }
}
