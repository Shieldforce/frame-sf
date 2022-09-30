<?php

declare(strict_types=1);

namespace Shieldforce\FrameSf\Middlewares\CustomizeCoreMiddlewares;

use Shieldforce\FrameSf\Database\Connection\Connection;
use Shieldforce\FrameSf\Middlewares\DefaultSystem\InterfaceMiddlewareDefault;
use Shieldforce\FrameSf\Request\Request;

class AuthMiddleware implements InterfaceMiddlewareDefault
{
    public static function run(Request $request)
    {
        $connection = Connection::get("sqlsrv");
        $array = [
            "id INT(255) PRIMARY KEY AUTO_INCREMENT NOT NULL",
            "name VARCHAR (30) NOT NULL",
            "email VARCHAR (50)"
        ];
        $connection->createTable("users", $array);
    }
}