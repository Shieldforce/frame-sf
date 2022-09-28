<?php

$route = \Shieldforce\FrameSf\Router\Route::getInstance();

$route->get(
    __FILE__,
    "/list/{id}",
    new \App\modules\Internal\controllers\InternalController(),
    "list",
    "list",
);
