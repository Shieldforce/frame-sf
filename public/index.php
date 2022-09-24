<?php

use App\Enums\ChannelsLogsEnum;
use App\Services\Log\LogCustomImplement;
use Dotenv\Dotenv;
use Monolog\Handler\BrowserConsoleHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use Shieldforce\FrameSf\BootSystem;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "../vendor/autoload.php";

/**
 * Startando logger pela primeira vez
 */
$logger = new Logger(ChannelsLogsEnum::LogBootSystem->value);
$logger->pushHandler(new BrowserConsoleHandler(Level::Debug));
$logger->pushHandler(new StreamHandler("../logs/frame-sf/logs.txt", Level::Warning));

/**
 * Garantindo que Logger será singleton
 */
$instance = \Shieldforce\FrameSf\Log\StartSingletonLogger::getInstance();
$instance->setLogger($logger);

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
