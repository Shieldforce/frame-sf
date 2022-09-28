<?php

declare(strict_types=1);

namespace Shieldforce\FrameSf\Errors\Logs;

use Monolog\Logger;
use Shieldforce\FrameSf\Sendgrid\SendgridSendCustom;

class SaveLogsErrors
{
    private Logger $logger;
    private array $toArray;

    public function logger(Logger $logger, array $toArray) : void
    {
        $this->logger = $logger;
        $this->toArray = $toArray;
    }

    public function debug(string $message, array $content, bool $mail = false) : void
    {
        $this->logger->debug(
            $message,
            $content
        );
        if($mail) {
            $this->sendMail(__FUNCTION__, $content);
        }
    }

    public function info(string $message, array $content, bool $mail = false) : void
    {
        $this->logger->info(
            $message,
            $content
        );
        if($mail) {
            $this->sendMail(__FUNCTION__, $content);
        }
    }

    public function notice(string $message, array $content, bool $mail = false) : void
    {
        $this->logger->notice(
            $message,
            $content
        );
        if($mail) {
            $this->sendMail(__FUNCTION__, $content);
        }
    }

    public function warning(string $message, array $content, bool $mail = false) : void
    {
        $this->logger->warning(
            $message,
            $content
        );
        if($mail) {
            $this->sendMail(__FUNCTION__, $content);
        }
    }

    public function error(string $message, array $content, bool $mail = false) : void
    {
        $this->logger->error(
            $message,
            $content
        );
        if($mail) {
            $this->sendMail(__FUNCTION__, $content);
        }
    }

    public function critical(string $message, array $content, bool $mail = true) : void
    {
        $this->logger->critical(
            $message,
            $content
        );
        if($mail) {
            $this->sendMail(__FUNCTION__, $content);
        }
    }

    public function alert(string $message, array $content, bool $mail = true) : void
    {
        $this->logger->alert(
            $message,
            $content
        );
        if($mail) {
            $this->sendMail(__FUNCTION__, $content);
        }
    }

    private function sendMail($level, array $content)
    {
        $send = new SendgridSendCustom($this->logger);
        foreach ($this->toArray as $to) {
            $send->addTo($to["mail"], $to["name"]);
        }
        $send->addContent("<div style='text-align: center;padding-top: 0;background: #cecece;color: black;'>");
        $send->addContent("<h1 style='background: #606060;color: white;'>Log level: (<span style='color: darkred;'>{$level}</span>) na aplicação!</h1>");
        $send->addContent("<div style='text-align: left;'>");
        $send->addContent("<ul>");
        foreach ($content as $index => $cont) {
            if(is_string($cont)) {
                $send->addContent("<li>[{$index}] -- {$cont}</li>");
            }
            if (is_array($cont)) {
                $send->addContent("<ul>");
                foreach ($cont as $index2 => $c) {
                    foreach ($c as $index3 => $cb) {
                        if(is_string($cb)) {
                            $send->addContent("<li>[{$index3}] -- {$cb}</li>");
                        }
                    }
                }
                $send->addContent("</ul>");
            }
        }
        $send->addContent("</ul>");
        $send->addContent("</div>");
        $send->execute("Problemas na aplicação: " . getenv("APP_NAME"), "text/html");
    }
}