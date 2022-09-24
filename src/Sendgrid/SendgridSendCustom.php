<?php

namespace Shieldforce\FrameSf\Sendgrid;

use Shieldforce\FrameSf\Errors\Logs\SaveLogsErrors;
use Shieldforce\FrameSf\Errors\Custom\SendgridSendException;

class SendgridSendCustom
{

    private array $toArray;
    private string $content = "";

    public function addContent($content)
    {
        $this->content .= $content;
    }

    public function addTo($mail, $name)
    {
        $this->toArray[] = [
            "mail" => $mail,
            "name" => $name
        ];
    }

    public function execute(string $subject, $typeContent = "text/html")
    {
        try {
            $email = new \SendGrid\Mail\Mail();
            $email->setFrom(getenv("SENDGRID_API_EMAIL_FROM"), getenv("APP_NAME"));
            $email->setSubject($subject);
            foreach ($this->toArray as $to) {
                $email->addTo($to["mail"], $to["name"] ?? "Mr. ");
            }
            $email->addContent($typeContent, $this->content ?? "<h1>Conteúdo não enviado!</h1>");
            $sendgrid = new \SendGrid(getenv('SENDGRID_AP_KEY'));
            $response = $sendgrid->send($email);
            if($response->statusCode() != 202) {
                throw new SendgridSendException("Erro ao enviar e-mail no sendgrid!");
            }
        } catch ( SendgridSendException $exception ) {
            $saveLog = new SaveLogsErrors($exception, "SendgridSendException");
            $saveLog->warning();
        }

    }
}