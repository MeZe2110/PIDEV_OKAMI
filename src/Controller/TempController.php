<?php

namespace App\Controller;

use App\Entity\Stock;
use App\Form\StockType;
use App\Repository\StockRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\NotifierInterface;
use PHPMailer\PHPMailer\PHPMailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle;

class TempController extends AbstractController
{
    #[Route('/temp', name: 'app_temp')]
    public function index(Request $request,StockRepository $stockRepository): Response
    { 
        $entityManager = $this->getDoctrine()->getManager();
    $stocks = $entityManager->getRepository(Stock::class);
        
        return $this->render('temp/index.html.twig', [
            'stocks' => 'stocks',
        ]);
    }
}
