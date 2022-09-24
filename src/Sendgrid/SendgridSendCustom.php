<?php

declare(strict_types=1);

namespace Shieldforce\FrameSf\Sendgrid;

use Shieldforce\FrameSf\Enums\ChannelsLogsEnum;

class SendgridSendCustom
{

    private array $toArray;
    private string $content = "";

    public function addContent(string $content)
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
        $email = new \SendGrid\Mail\Mail();
        $email->setFrom(getenv("SENDGRID_API_EMAIL_FROM"), getenv("APP_NAME"));
        $email->setSubject($subject);
        foreach ($this->toArray as $to) {
            $email->addTo($to["mail"], $to["name"] ?? "Mr. ");
        }
        $email->addContent($typeContent, $this->content ?? "<h1>Conteúdo não enviado!</h1>");
        $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
        $response = $sendgrid->send($email);
        if($response->statusCode() != 202) {
            \Shieldforce\FrameSf\Log\LogCustomImplement::error(
                ChannelsLogsEnum::LogExternalPackage,
                "Problemas em enviar e-mail pelo sendgrid!",
                [
                    "file" => __DIR__,
                    "line" => "36 entry 44",
                    "headers" => $response->headers(),
                    "body" => $response->body(),
                ]
            );

        }
    }
}