<?php

namespace App\Command;

use App\Entity\Rendezvous;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Twig\Environment;

class RendezvousNotification extends Command
{
    
    protected static $defaultName = 'app:rendezvous-reminder';
    protected static $defaultDescription = 'Send a reminder for upcoming rendezvous.';

    private $entityManager;
    private $mailer;
    private $twig;

    public function __construct(EntityManagerInterface $entityManager, MailerInterface $mailer, Environment $twig)
    {
        parent::__construct();

        $this->entityManager = $entityManager;
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    protected function configure()
    {
        $this->setDescription(self::$defaultDescription);
    }

    // protected function execute(InputInterface $input, OutputInterface $output)
    // {
    //     $now = new \DateTime();

    //     $rendezvousRepository = $this->entityManager->getRepository(Rendezvous::class);
    //     $rendezvous = $rendezvousRepository->createQueryBuilder('r')
    //         ->where('r.daterv BETWEEN :start AND :end')
    //         ->andWhere('r.Rappel = true')
    //         ->setParameter('start', $now)
    //         ->setParameter('end', (clone $now)->modify('+1 day'))
    //         ->getQuery()
    //         ->getResult();

    //     foreach ($rendezvous as $r) {
    //         $users = $r->getUtilisateur();
    //         $userEmails = [];
    //         foreach ($users as $user) {
    //             $userEmails[] = $user->getEmailut();
    //         }

    //         // Create and send the email
    //         // $email = (new Email())
    //         //     ->from('HealthHerald.NoReply@gmail.com')
    //         //     ->to(...$userEmails)
    //         //     ->subject('Rappel: Rendezvous')
    //         //     ->html($this->twig->render(
    //         //         'emails/rendezvousNotification.html.twig',
    //         //         ['rendezvous' => $r]
    //         //     ));

    //         $templateEmail = (new TemplatedEmail())
    //             ->from('HealthHerald.NoReply@gmail.com')
    //             ->to(...$userEmails)
    //             ->subject('Rappel: Rendezvous')
    //             ->htmlTemplate('emails/rendezvousNotification.html.twig')
    //             ->context(['rendezvous' => $r]);

    //         $this->mailer->send($templateEmail);

    //         $r->setRappel(false);

    //         $this->entityManager->persist($r);
    //     }
    //     $this->entityManager->flush();
    //     return 0;
    // }


    protected function execute(InputInterface $input, OutputInterface $output) : int
     {
        $rendezvousRepository = $this->entityManager->getRepository(Rendezvous::class);
        $rendezvous = $rendezvousRepository->createQueryBuilder('r')
             ->where('r.id = 2')
             ->getQuery()
             ->getResult();
    $templateEmail = (new TemplatedEmail())
                ->from('healthherald.noreply@gmail.com')
                ->to('ilyesluisnessim.novellaguediche@esprit.tn')
                ->subject('Rappel: Rendezvous')
                ->htmlTemplate('emails/rendezvousNotification.html.twig')
                ->context(['rendezvous' => $rendezvous]);

            $this->mailer->send($templateEmail);

            return 0;
        }




}