<?php

$route = \Shieldforce\FrameSf\Router\Route::getInstance();
$controller = new \App\modules\ExampleModule\controllers\Panel\MainController();

$route->get(
    __FILE__,
    "/dashboard",
    $controller,
    "dashboard",
    "panel.dashboard"
);