<?php

function exceptionLogArray($exception)
{
    return [
        "code" => $exception->getCode(),
        "message" => $exception->getMessage(),
        "line" => $exception->getLine(),
        "file" => $exception->getFile(),
        "trace" => $exception->getTrace(),
        "trance_string" => $exception->getTraceAsString(),
        "previous" => $exception->getPrevious(),
    ];
}

function emailsToSendgridChannels($channel)
{
    $return = [
        "LogBootSystem" => [
            ["mail" => "shieldforce2@gmail.com" , "name" => "Alexandre Ferreira"],
            ["mail" => "alexandrefn7@gmail.com" , "name" => "Alexandre Ferreira"],
        ],
        "LogInternalReneric" => [
            ["mail" => "shieldforce2@gmail.com" , "name" => "Alexandre Ferreira"],
            ["mail" => "alexandrefn7@gmail.com" , "name" => "Alexandre Ferreira"],
        ],
        "LogExternalPackage" => [
            ["mail" => "shieldforce2@gmail.com" , "name" => "Alexandre Ferreira"],
            ["mail" => "alexandrefn7@gmail.com" , "name" => "Alexandre Ferreira"],
        ],
    ];
    return $return[$channel];
}

function getInstanceLogger() : \Monolog\Logger
{
    $instance = \Shieldforce\FrameSf\Log\StartSingletonLogger::getInstance();
    return $instance->getLogger();
}
