<?php

declare(strict_types=1);

namespace Shieldforce\FrameSf\Middlewares;

use App\modules\ExampleModule\middlewares\Kernel;
use Shieldforce\FrameSf\Middlewares\CustomizeCoreMiddlewares\AuthMiddleware;
use Shieldforce\FrameSf\Middlewares\DefaultSystem\DefaultCoreMiddleware;
use Shieldforce\FrameSf\Router\Route;

class MiddlewareKernel
{
    public static function init(Route $route)
    {
        $middlewaresRouteCurrent = $route->getCurrentRoute()->middlewares ?? [];
        self::defaultCore();
        self::customCore($middlewaresRouteCurrent);
    }

    private static function defaultCore()
    {
        return  array_merge([
            DefaultCoreMiddleware::run(request())

        ], Kernel::defaults());
    }

    private static function customCore(array $arrayMiddlewaresRouteCurrent = [])
    {
        $arrayNew = [];
        $return =  array_merge([
            "auth" => AuthMiddleware::class
        ], Kernel::customs());
        foreach ($arrayMiddlewaresRouteCurrent as $middleware) {
            if($return[$middleware]) {
                $return[$middleware]::run(request());
            }
        }
        return $arrayNew;
    }
}