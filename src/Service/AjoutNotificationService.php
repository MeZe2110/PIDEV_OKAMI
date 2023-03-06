<?php
namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use App\Entity\Stock;
class AjoutNotificationService
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendEmailIfnew(Stock $stock): void
    {   
            $email = (new Email())
                ->from('baltiamine@gmail.com')
                ->to('balti.mohamedamine@esprit.tn')
                ->subject('New Comment Requires Approval')
                ->text(sprintf('quantite de 
                 "%s"inferieure a 10.',$stock->getNomst()));
            $this->mailer->send($email);


               
    }
}