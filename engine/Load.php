<?php

namespace Engine;

class Load
{
    private const string MASK_MODEL_ENTITY     = '\%s\Model\%s\%s';
    private const string MASK_MODEL_REPOSITORY = '\%s\Model\%s\%sRepository';


    /**
     * @param $modelName
     * @param $modelDir
     * @param $env
     * @return \stdClass
     */
    public function model($modelName, $modelDir = false, $env = false)
    {
        global $di;

        $modelName  = ucfirst($modelName);
        $model      = new \stdClass();
        $modelDir   = $modelDir ? $modelDir : $modelName;
        $env        = $env ? $env : ENV;

        $namespaceEntity = sprintf(
            self::MASK_MODEL_ENTITY,
            $env,
            $modelDir,
            $modelName
        );

        $namespaceRepository = sprintf(
            self::MASK_MODEL_REPOSITORY,
            ENV,
            $modelDir,
            $modelName
        );

        $model->entity     = $namespaceEntity;
        $model->repository = new $namespaceRepository($di);

        return $model;
    }
}
