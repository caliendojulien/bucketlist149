<?php

namespace App\Services;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class envoieEmail
{

    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    function envoi(string $sujet): void
    {
        // composer req symfony/mailer
        $mail = new Email();
        $mail
            ->from('batman@eni.fr')
            ->to('bob@eni.fr')
            ->subject($sujet)
            ->html('<p>Un super email</p>');
        $this->mailer->send($mail);
    }

}