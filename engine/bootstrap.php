<?php

use Engine\Cms;
use Engine\DI\DI;

try {
    //Dependency injection
    $di = new DI();

    $services = require __DIR__ . '/config/service.php';

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
