<?php

declare(strict_types=1);

namespace Shieldforce\FrameSf\Log;

use Monolog\Handler\BrowserConsoleHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use Shieldforce\FrameSf\Enums\ChannelsLogsEnum;

class StartSingletonLogger
{
    private static ?StartSingletonLogger $instance;

    private ?Logger $logger;

    private function __construct()
    {
        $this->setLogger();
    }

    private function __clone()
    {
    }

    public function __wakeup()
    {
    }

    public static function getInstance() : StartSingletonLogger
    {
        if (!isset(self::$instance)) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    public function setLogger()
    {
        $logger = new Logger(ChannelsLogsEnum::LogBootSystem->value);
        $logger->pushHandler(new BrowserConsoleHandler(Level::Debug));
        $logger->pushHandler(new StreamHandler("../logs/frame-sf/logs.txt", Level::Warning));
        $this->logger = $logger;
    }

    public function getLogger() : Logger
    {
        return $this->logger;
    }
}