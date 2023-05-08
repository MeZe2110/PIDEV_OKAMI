<?php
namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use App\Entity\Vehicules;
class AjoutNotificationService
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendEmailIfnew(Vehicules $Vehicule): void
    {   
            $email = (new Email())
                ->from('troudik033@gmail.com')
                ->to('mouhamedkhaled.baoueb@esprit.tn')
                ->subject('Un nouveau véhicule a été ajouté  ')
                ->text(sprintf('Un nouveau véhicule avec nom "%s" a été ajouté.', $Vehicule->getNomvh()));
            $this->mailer->send($email);
    }


}