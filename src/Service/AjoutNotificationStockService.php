<?php
namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use App\Entity\Stock;
class AjoutNotificationStockService
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendEmailIfnewS(Stock $stock): void
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