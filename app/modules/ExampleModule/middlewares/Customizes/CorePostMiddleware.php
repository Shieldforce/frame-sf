<?php

declare(strict_types=1);

namespace App\modules\ExampleModule\middlewares\Customizes;

use Shieldforce\FrameSf\Middlewares\DefaultSystem\InterfaceMiddlewareDefault;
use Shieldforce\FrameSf\Request\Request;

class CorePostMiddleware implements InterfaceMiddlewareDefault
{
    public static function run(Request $request)
    {
        // Implementar um middleware cutomizado
        return true;
    }
}