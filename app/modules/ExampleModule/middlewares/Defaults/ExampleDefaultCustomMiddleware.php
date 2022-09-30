<?php

declare(strict_types=1);

namespace App\modules\ExampleModule\middlewares\Defaults;

use Shieldforce\FrameSf\Middlewares\DefaultSystem\InterfaceMiddlewareDefault;
use Shieldforce\FrameSf\Request\Request;

class ExampleDefaultCustomMiddleware implements InterfaceMiddlewareDefault
{
    public static function run(Request $request)
    {
        // Implementar um middleware default
        return true;
    }
}