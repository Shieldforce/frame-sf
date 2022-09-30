<?php

declare(strict_types=1);

namespace App\modules\ExampleModule\middlewares;

use App\modules\ExampleModule\middlewares\Customizes\CorePostMiddleware;
use App\modules\ExampleModule\middlewares\Defaults\ExampleDefaultCustomMiddleware;

class Kernel
{
    public static function defaults()
    {
        return [
            ExampleDefaultCustomMiddleware::run(request())
        ];
    }

    public static function customs()
    {
        return [
            "corePost" => CorePostMiddleware::class
        ];
    }
}