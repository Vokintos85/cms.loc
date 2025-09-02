<?php

namespace Engine\Core\Template;

use Admin\Model\Setting\SettingRepository;
use Engine\DI\DI;

class Setting
{
    /**
     * @var
     */
    protected static DI $di;

    /**
     * @var
     */
    protected static SettingRepository $settingRepository;

    public function __construct($di)
    {
        self::$di = $di;
        self::$settingRepository = new SettingRepository (self::$di);
    }

    /**
     * @return mixed
     */
    public static function get($keyField)
    {
        return self::$settingRepository->getSettingValue($keyField);
    }

}
