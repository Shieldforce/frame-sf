<?php

declare(strict_types=1);

namespace Shieldforce\FrameSf\Database\Connection;

use Shieldforce\FrameSf\Database\DriverConnection;

class Connection
{
    public static function get(string $nameConnection)
    {
        return DriverConnection::connection($nameConnection);
    }
}