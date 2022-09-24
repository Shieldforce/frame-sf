<?php

declare(strict_types=1);

namespace Shieldforce\FrameSf\Log;

use Monolog\Logger;

class StartSingletonLogger
{
    private static ?StartSingletonLogger $instance;

    private ?Logger $logger;

    private function __construct()
    {
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

    public function setLogger(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function getLogger() : Logger
    {
        return $this->logger;
    }
}