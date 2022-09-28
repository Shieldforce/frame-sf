<?php

$route = \Shieldforce\FrameSf\Router\Route::getInstance();
$controller = new \App\modules\ExampleModule\controllers\Home\MainController();

$route->get(
    __FILE__,
    "/",
    $controller,
    "index",
    "home.index"
);

$route->get(
    __FILE__,
    "/about",
    $controller,
    "about",
    "home.about",
);

$route->get(
    __FILE__,
    "/apiOrHtml",
    $controller,
    "apiOrHtml",
    "home.apiOrHtml",
);