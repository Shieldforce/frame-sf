<?php

declare(strict_types=1);

namespace Shieldforce\FrameSf;

use Shieldforce\FrameSf\Middlewares\MiddlewareKernel;
use Shieldforce\FrameSf\Modules\CaptureModules;
use Shieldforce\FrameSf\Router\ManipulationFilesAndDir;

class BootSystem
{
    public function start()
    {
        $manipulationFilesAndDir = new ManipulationFilesAndDir();
        $manipulationFilesAndDir::readRoutes("../app/modules/");
        $route = \Shieldforce\FrameSf\Router\Route::getInstance();
        $captureModules = new CaptureModules();
        $captureModules::addModule($manipulationFilesAndDir->getPathAccepts());
        $route->setModules($captureModules->getModules());
        $route->setCurrentRoute();
        $controller = $route->getCurrentRoute()->controller;
        $method = $route->getCurrentRoute()->method;
        request()->setCurrentRoute($route);
        MiddlewareKernel::init($route);
        return $controller->{$method}();
    }
}