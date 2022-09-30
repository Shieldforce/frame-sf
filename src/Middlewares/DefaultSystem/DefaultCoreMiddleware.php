<?php

declare(strict_types=1);

namespace Shieldforce\FrameSf\Middlewares\DefaultSystem;

use Shieldforce\FrameSf\Request\Request;

class DefaultCoreMiddleware implements InterfaceMiddlewareDefault
{
    public static function run(Request $request)
    {
        return true;
    }
}