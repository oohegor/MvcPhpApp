<?php

declare(strict_types=1);

class MailService
{
    public function __construct(
        private string $to = ENV['MAIL_TO'],
        private string $from = ENV['MAIL_FROM'],
    )
    {
    }

    public function sendMail(string $subject, string $message): void
    {
        $message = wordwrap($message, 500, "\r\n");

        $headers = 'From: ' . $this->from . "\r\n" .
            'Reply-To: ' . $this->from . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        mail($this->to, $subject, $message, $headers);
    }
}
