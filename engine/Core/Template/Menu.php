<?php

namespace Engine\Core\Template;

use Cms\Controller\Model\Menu\MenuRepository;

class Menu
{
    /**
     * @var
     */
    protected static $di;

    /**
     * @var
     */
    protected static $menuRepository;

    public function __construct($di)
    {
        self::$di = $di;
        self::$menuRepository = new MenuRepository (self::$di);
    }

    public static function show()
    {

    }

    public static function getItems()
    {
        return self::$menuRepository->getAllitems();
    }

}