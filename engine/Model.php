<?php

namespace Engine;


use Engine\Core\Database\Connection;
use Engine\Core\Database\QueryBuilder;
use Engine\DI\DI;

abstract class Model
{
    protected DI $di;

    protected Connection $db;
    protected array $config;

    protected QueryBuilder $queryBilder;


    /**
     * @param DI $di
     */
    public function __construct(DI $di)
    {
        $this->di      = $di;
        $this->db      = $di->get('db');
        $this->config  = $di->get('config');

        $this->queryBilder = new QueryBuilder();
    }
}
