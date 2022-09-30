<?php

declare(strict_types=1);

use Dotenv\Dotenv;
use Shieldforce\FrameSf\BootSystem;
use Shieldforce\FrameSf\Enums\ChannelsLogsEnum;
use Shieldforce\FrameSf\Errors\Custom\MethodIncorretException;
use Shieldforce\FrameSf\Errors\Custom\PageNotFoundException;
use Shieldforce\FrameSf\Errors\Custom\RouteInDuplicityException;
use Shieldforce\FrameSf\Log\LogCustomImplement;

require "../vendor/autoload.php";

config_init();

try {

    $dotenv = Dotenv::createUnsafeImmutable("../"); $dotenv->load();

    $bootSystem = new BootSystem();
    $bootSystem->start();

} catch (PageNotFoundException $exception) {

    $array = exceptionLogArray($exception);
    LogCustomImplement::error(
        ChannelsLogsEnum::LogInternalPageNotFoundCore,
        $array["message"],
        $array
    );

} catch (RouteInDuplicityException $exception) {

    $array = exceptionLogArray($exception);
    LogCustomImplement::error(
        ChannelsLogsEnum::LogInternalRouteCore,
        $array["message"],
        $array
    );

} catch (MethodIncorretException $exception) {

    $array = exceptionLogArray($exception);
    LogCustomImplement::error(
        ChannelsLogsEnum::LogInternalMethodCore,
        $array["message"],
        $array
    );

} catch (\Throwable $exception) {

    $array = exceptionLogArray($exception);
    LogCustomImplement::error(
        ChannelsLogsEnum::LogInternalReneric,
        $array["message"],
        $array
    );

}
