<?php

declare(strict_types=1);

namespace App\Services\Log;

use App\Enums\ChannelsLogsEnum;
use Shieldforce\FrameSf\Errors\Logs\SaveLogsErrors;

class LogCustomImplement
{
    public static function debug(ChannelsLogsEnum $channel = ChannelsLogsEnum::LogBootSystem, string $message = "", array $arrayContent = [])
    {
        $saveLog = new SaveLogsErrors();
        $logger  = getInstanceLogger();
        $logger  = $logger->withName($channel->value);
        $saveLog->logger($logger, emailsToSendgridChannels($channel->value));
        $saveLog->debug($message, $arrayContent);
    }

    public static function info(ChannelsLogsEnum $channel = ChannelsLogsEnum::LogBootSystem, string $message = "", array $arrayContent = [])
    {
        $saveLog = new SaveLogsErrors();
        $logger  = getInstanceLogger();
        $logger  = $logger->withName($channel->value);
        $saveLog->logger($logger, emailsToSendgridChannels($channel->value));
        $saveLog->info($message, $arrayContent);
    }

    public static function notice(ChannelsLogsEnum $channel = ChannelsLogsEnum::LogBootSystem, string $message = "", array $arrayContent = [])
    {
        $saveLog = new SaveLogsErrors();
        $logger  = getInstanceLogger();
        $logger  = $logger->withName($channel->value);
        $saveLog->logger($logger, emailsToSendgridChannels($channel->value));
        $saveLog->notice($message, $arrayContent);
    }

    public static function warning(ChannelsLogsEnum $channel = ChannelsLogsEnum::LogBootSystem, string $message = "", array $arrayContent = [])
    {
        $saveLog = new SaveLogsErrors();
        $logger  = getInstanceLogger();
        $logger  = $logger->withName($channel->value);
        $saveLog->logger($logger, emailsToSendgridChannels($channel->value));
        $saveLog->warning($message, $arrayContent);
    }

    public static function error(ChannelsLogsEnum $channel = ChannelsLogsEnum::LogBootSystem, string $message = "", array $arrayContent = [])
    {
        $saveLog = new SaveLogsErrors();
        $logger = getInstanceLogger();
        $logger = $logger->withName($channel->value);
        $saveLog->logger($logger, emailsToSendgridChannels($channel->value));
        $saveLog->error($message, $arrayContent);
    }

    public static function critical(ChannelsLogsEnum $channel = ChannelsLogsEnum::LogBootSystem, string $message = "", array $arrayContent = [])
    {
        $saveLog = new SaveLogsErrors();
        $logger  = getInstanceLogger();
        $logger  = $logger->withName($channel->value);
        $saveLog->logger($logger, emailsToSendgridChannels($channel->value));
        $saveLog->critical($message, $arrayContent);
    }

    public static function alert(ChannelsLogsEnum $channel = ChannelsLogsEnum::LogBootSystem, string $message = "", array $arrayContent = [])
    {
        $saveLog = new SaveLogsErrors();
        $logger  = getInstanceLogger();
        $logger  = $logger->withName($channel->value);
        $saveLog->logger($logger, emailsToSendgridChannels($channel->value));
        $saveLog->alert($message, $arrayContent);
    }
}