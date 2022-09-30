<?php

declare(strict_types=1);

namespace Shieldforce\FrameSf\Database;

use Shieldforce\FrameSf\Database\Drivers\Mysql;
use Shieldforce\FrameSf\Database\Drivers\Postgres;
use Shieldforce\FrameSf\Database\Drivers\Sqlite;
use Shieldforce\FrameSf\Database\Drivers\Sqlsrv;

class DriverConnection
{

    private static ?DriverConnection $instance;

    private function __clone()
    {
    }

    public function __wakeup()
    {
    }

    public static function getInstance() : DriverConnection
    {
        if (!isset(self::$instance)) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    public static function connection($nameConnection)
    {
        $dataDonnections = config("database");
        foreach ($dataDonnections as $dataConnection) {
            $driverName = $dataConnection['DB_DRIVER'];
            if($driverName=="mysql" && $nameConnection == $dataConnection['DB_CONNECTION']) {
                return new Mysql($dataConnection);
            } elseif($driverName=="sqlsrv" && $nameConnection == $dataConnection['DB_CONNECTION']) {
                return new Sqlsrv($dataConnection);
            } elseif($driverName=="postgres" && $nameConnection == $dataConnection['DB_CONNECTION']) {
                return new Postgres($dataConnection);
            } elseif($driverName=="sqlite" && $nameConnection == $dataConnection['DB_CONNECTION']) {
                return new Sqlite($dataConnection);
            }
        }
        return null;
    }
}