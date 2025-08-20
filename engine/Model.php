<?php

namespace Engine;


use Engine\Core\Database\QueryBuilder;
use Engine\DI\DI;

abstract class Model
{
    /**
     * @var DI
     */
    protected $di;

    protected $db;

    protected array $config;

    public $queryBilder;


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
