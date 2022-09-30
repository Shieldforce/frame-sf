<?php

declare(strict_types=1);

namespace Shieldforce\FrameSf\Middlewares\DefaultSystem;

use Shieldforce\FrameSf\Request\Request;

interface InterfaceMiddlewareDefault
{
    public static function run(Request $request);
}