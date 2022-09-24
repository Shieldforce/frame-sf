<?php

declare(strict_types=1);

namespace Shieldforce\FrameSf\Errors\Logs;

use Monolog\Handler\BrowserConsoleHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use Shieldforce\FrameSf\Sendgrid\SendgridSendCustom;
use Throwable;

class SaveLogsErrors
{
    private Throwable $exception;
    private Logger $logger;
    private $errorInArray;

    public function __construct(Throwable $exception, $channel = "web")
    {
        $this->exception = $exception;
        $this->logger = new Logger($channel);
        $this->errorInArray = $this->errorInArray();
        $this->initHandlers();
    }

    private function initHandlers()
    {
        $this->logger->pushHandler(new BrowserConsoleHandler(Level::Debug));
        $this->logger->pushHandler(new StreamHandler("../logs/frame-sf/logs.txt", Level::Warning));
    }

    public function debug($message=null, $exception=null, $mail = false)
    {
        $this->logger->debug(
            $message ?? $this->errorInArray["message"],
            $exception ?? $this->errorInArray
        );
        if($mail) {
            $this->sendMail(__FUNCTION__);
        }
    }

    public function info($message=null, $exception=null, $mail = false)
    {
        $this->logger->info(
            $message ?? $this->errorInArray["message"],
            $exception ?? $this->errorInArray
        );
        if($mail) {
            $this->sendMail(__FUNCTION__);
        }
    }

    public function notice($message=null, $exception=null, $mail = false)
    {
        $this->logger->notice(
            $message ?? $this->errorInArray["message"],
            $exception ?? $this->errorInArray
        );
        if($mail) {
            $this->sendMail(__FUNCTION__);
        }
    }

    public function warning($message=null, $exception=null, $mail = false)
    {
        $this->logger->warning(
            $message ?? $this->errorInArray["message"],
            $exception ?? $this->errorInArray
        );
        if($mail) {
            $this->sendMail(__FUNCTION__);
        }
    }

    public function error($message=null, $exception=null, $mail = false)
    {
        $this->logger->error(
            $message ?? $this->errorInArray["message"],
            $exception ?? $this->errorInArray
        );
        if($mail) {
            $this->sendMail(__FUNCTION__);
        }
    }

    public function critical($message=null, $exception=null, $mail = true)
    {
        $this->logger->critical(
            $message ?? $this->errorInArray["message"],
            $exception ?? $this->errorInArray
        );
        if($mail) {
            $this->sendMail(__FUNCTION__);
        }
    }

    public function alert($message=null, $exception=null, $mail = true)
    {
        $this->logger->alert(
            $message ?? $this->errorInArray["message"],
            $exception ?? $this->errorInArray
        );
        if($mail) {
            $this->sendMail(__FUNCTION__);
        }
    }

    private function errorInArray()
    {
        $exception                = $this->exception;
        $array                    = [];
        $array["message"]         = $exception->getMessage();
        $array["code"]            = $exception->getCode();
        $array["file"]            = $exception->getFile();
        $array["line"]            = $exception->getLine();
        $array["previous"]        = $exception->getPrevious();
        $array["trace"]           = $exception->getTrace();
        $array["trace_as_string"] = $exception->getTraceAsString();
        return $array;
    }

    private function sendMail($level)
    {
        $send = new SendgridSendCustom();
        $send->addTo("shieldforce2@gmail.com", "Alexandre Ferreira");
        $send->addContent("<div style='text-align: center;padding: 5px;background: #cecece;color: red;'>");
        $send->addContent("<h1>Erro level: (<span style='color: darkred;'>{$level}</span>) na aplicação!</h1>");
        $send->addContent("</div>");
        $send->addContent("<div style='text-align: left;'>");
        $send->addContent("<ul>");
        $errors = $this->errorInArray();
        $send->addContent("<li>Código: {$errors['code']}</li>");
        $send->addContent("<li>Messagem: {$errors['message']}</li>");
        $send->addContent("<li>Arquivo: {$errors['file']}</li>");
        $send->addContent("<li>Linha: {$errors['line']}</li>");
        $send->addContent("<li>Prévia: {$errors['previous']}</li>");
        if(isset($errors['trace']) && count($errors['trace']) > 0) {
            $send->addContent("<li>Aruivos Relacionados: ");
            $send->addContent("<ul>");
            foreach ($errors['trace'] as $trace) {
                $send->addContent("<li>Arquivo: {$trace["file"]} | Linha: {$trace["line"]}</li>");
            }
            $send->addContent("</ul>");
            $send->addContent("</li>");
            $send->addContent("<li>Aruivos Relacionados em texto: {$errors['trace_as_string']}</li>");
        }
        $send->addContent("</ul>");
        $send->addContent("</div>");
        $send->execute("Problemas na aplicação: " . getenv("APP_NAME"), "text/html");
    }
}