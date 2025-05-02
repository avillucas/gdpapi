<?php

use Mailgun\Mailgun;
use App\Infrastructure\Service\EmailTransportInterface;

class MailgunEmailTransport implements EmailTransportInterface
{

    protected Mailgun $sender;
    protected string $domain;

    public function __construct(string $domain, string $key)
    {
        $this->domain = $domain;
        $this->sender = Mailgun::create($key);
    }

    public function send(string $to, string $from, string $subject, string $textBody, string $htmlBody)
    {
        $this->sender->messages()->send('example.com', [
            'from'    => $from,
            'to'      => $to,
            'subject' => $subject,
            'text'    => $textBody,
            'html'    => $htmlBody
        ]);
    }
}
