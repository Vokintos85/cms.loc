<?php

namespace Engine\Core\Template;

use Admin\Model\Setting\SettingRepository;

class Setting
{
    /**
     * @var
     */
    protected static $di;

    /**
     * @var
     */
    protected static $settingRepository;

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