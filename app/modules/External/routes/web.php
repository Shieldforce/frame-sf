<?php

$route = \Shieldforce\FrameSf\Router\Route::getInstance();

$route->get(
    __FILE__,
    "/list/{id}/{teste}",
    new \App\modules\External\controllers\ExternalController(),
    "list",
    "list",
);

$route->get(
    __FILE__,
    "/show/{id}",
    new \App\modules\External\controllers\ExternalController(),
    "show",
    "show",
);