<?php

declare(strict_types=1);

use Dotenv\Dotenv;
use Shieldforce\FrameSf\BootSystem;
use Shieldforce\FrameSf\Enums\ChannelsLogsEnum;
use Shieldforce\FrameSf\Log\LogCustomImplement;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('error_reporting', E_ALL);
error_reporting(E_ALL);

require "../vendor/autoload.php";

try {

    $dotenv = Dotenv::createUnsafeImmutable("../"); $dotenv->load();

    $bootSystem = new BootSystem();
    $bootSystem->start();

} catch (\Throwable $exception) {

    $array = exceptionLogArray($exception);
    LogCustomImplement::error(
        ChannelsLogsEnum::LogInternalReneric,
        $array["message"],
        $array
    );

}
