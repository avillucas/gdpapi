<?php

namespace App\Infrastructure\Service;

use Mailgun\Mailgun;
use App\Domain\Contact\Contact;
use App\Infrastructure\Service\EmailTransportInterface;

class MailgunEmailTransport implements EmailTransportInterface
{

    const DEFAULT_SUBJECT = 'Ha recibido un email desde el sitio web';
    protected Mailgun $sender;
    protected string $domain;
    protected string $toEmail;

    public function __construct(string $domain, string $key, string $toEmail)
    {
        $this->domain = $domain;
        $this->sender = Mailgun::create($key);
    }

    protected function send(string $to, string $from, string $subject, string $textBody, ?string $htmlBody = null)
    {
        $htmlBody = $htmlBody ?? nl2br($textBody);
        $this->sender->messages()->send('example.com', [
            'from'    => $from,
            'to'      => $to,
            'subject' => $subject,
            'text'    => $textBody,
            'html'    => $htmlBody
        ]);
    }

    public function sendContactEmail(Contact $contact): void
    {
        $subject = 'Ha recibido un email desde el formulario de contacto de la web ';
        $textBody = sprintf('
        Ha recibido un email desde el sitio web 
        Nombre: %s
        Email: %s
        Comentario: %s
        ', $contact->getName(), $contact->getEmail(), $contact->getComments());
        $this->send($this->toEmail, $contact->getEmail(), $subject, $textBody, null);
    }
}
