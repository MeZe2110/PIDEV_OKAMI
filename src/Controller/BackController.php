<?php

namespace App\Controller;

use App\Repository\HistoriqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BackController extends AbstractController
{
    #[Route('/back_index', name: 'back_index')]
    public function index(HistoriqueRepository $historiqueRepository): Response
    {
        return $this->render('Template_Back/index.html.twig', [
            'historique' => $historiqueRepository->findAll(),
        ]);
    }

    #[Route('/back_profile', name: 'back_profile')]
    public function profile(): Response
    {
        return $this->render('Template_Back/profile.html.twig');
    }

    #[Route('/back_blank', name: 'back_blank')]
    public function blank(): Response
    {
        return $this->render('Template_Back/blank.html.twig');
    }
    #[Route('/back_charts', name: 'back_charts')]
    public function charts(): Response
    {
        return $this->render('Template_Back/charts.html.twig');
    }

    #[Route('/back_contact', name: 'back_contact')]
    public function contact(): Response
    {
        return $this->render('Template_Back/contact.html.twig');
    }

    #[Route('/back_faq', name: 'back_faq')]
    public function faq(): Response
    {
        return $this->render('Template_Back/faq.html.twig');
    }

    #[Route('/back_forms', name: 'back_forms')]
    public function forms(): Response
    {
        return $this->render('Template_Back/forms.html.twig');
    }

    #[Route('/back_tablesgeneral', name: 'back_tablesgeneral')]
    public function tablesgeneral(): Response
    {
        return $this->render('Template_Back/tablesgeneral.html.twig');
    }

    #[Route('/back_tablesdata', name: 'back_tablesdata')]
    public function tablesdata(): Response
    {
        return $this->render('Template_Back/tablesdata.html.twig');
    }

    #[Route('/back_login', name: 'back_login')]
    public function login(): Response
    {
        return $this->render('Template_Back/login.html.twig');
    }

    #[Route('/back_register', name: 'back_register')]
    public function register(): Response
    {
        return $this->render('Template_Back/register.html.twig');
    }

    #[Route('/back_error404', name: 'back_error404')]
    public function error(): Response
    {
        return $this->render('Template_Back/error404.html.twig');
    }
}
