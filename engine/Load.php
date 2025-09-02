<?php

namespace Engine;

use Engine\DI\DI;

class Load
{

    private const string MASK_MODEL_ENTITY = '\%s\Model\%s\%s';
    private const string MASK_MODEL_REPOSITORY = '\%s\Model\%s\%sRepository';

    public function __construct(private DI $di)
    {
    }

    public function model(string $modelName, bool $modelDir = false, false|string $env = false)
    {
        $modelName = ucfirst($modelName);

        $modelDir = $modelDir ? $modelDir : $modelName;
        $env = $env ? $env : ENV;

        $namespaceEntity = sprintf(
            self::MASK_MODEL_ENTITY,
            $env,
            $modelDir,
            $modelName
        );

        $namespaceRepository = sprintf(
            self::MASK_MODEL_REPOSITORY,
            $env,
            $modelDir,
            $modelName
        );

        $model = new \stdClass();
        $model->entity = $namespaceEntity;
        $model->repository = new $namespaceRepository($this->di);

        return $model;
    }
}
