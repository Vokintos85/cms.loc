<?php

require __DIR__ . '/../vendor/autoload.php';

class_alias('Engine\\Core\\Template\\Asset', 'Asset');
class_alias('Engine\\Core\\Template\\Theme', 'Theme');
class_alias('Engine\\Core\\Template\\Setting', 'Setting');
class_alias('Engine\\Core\\Template\\Menu', 'Menu');
use Engine\Cms;
use Engine\DI\DI;

try {
    //Dependency injection
    $di = new DI();

    $services = require __DIR__ . '/Config/service.php';

    //Init services
    foreach ($services as $service) {
        $provider = new $service($di);
        $provider->init();
    }

    $cms = new Cms($di);
    $cms->run();
} catch (\ErrorException $e) {
    echo $e->getMessage();
}
