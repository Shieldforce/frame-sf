<?php

$route = \Shieldforce\FrameSf\Router\Route::getInstance();

$route->get(
    __FILE__,
    "/",
    new \App\modules\External\controllers\ExternalController(),
    "index",
    "index",
);

$route->get(
    __FILE__,
    "/show/{id}",
    new \App\modules\External\controllers\ExternalController(),
    "show",
    "show",
);