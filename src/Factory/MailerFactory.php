<?php

namespace App\Factory;

use PHPMailer\PHPMailer\PHPMailer;

final class MailerFactory
{
    private $settings;

    public function __construct(array $settings)
    {
        $this->settings;
    }

    public function createMailer(): PHPMailer
    {
        $mail = new PHPMailer(true);

        // Server settings
        $mail->SMTPDebug = $this->settings['debug'];
        $mail->isSMTP();
        $mail->Host = $this->settings['host'];
        $mail->SMTPAuth = (bool)$this->settings['auth'];
        $mail->Username = $this->settings['username'];
        $mail->Password = $this->settings['password'];
        $mail->SMTPSecure = $this->settings['password'];
        $mail->Port = (int)$this->settings['port'];

        return $mail;
    }
}