<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BackController extends AbstractController
{
    #[Route('/back', name: 'back_base')]
    #[Route('/back/index', name: 'back_index')]
    public function index(): Response
    {
        return $this->render('Template_Back/index.html.twig');
    }
    
    #[Route('/back/blank', name: 'back_blank')]
    public function blank(): Response
    {
        return $this->render('Template_Back/blank.html.twig');
    }    

    #[Route('/back/charts', name: 'back_charts')]
    public function chartsjs(): Response
    {
        return $this->render('Template_Back/charts.html.twig');
    }    
    
    #[Route('/back/contact', name: 'back_contact')]
    public function contact(): Response
    {
        return $this->render('Template_Back/contact.html.twig');
    }    
    
    #[Route('/back/error404', name: 'back_error404')]
    public function error404(): Response
    {
        return $this->render('Template_Back/error404.html.twig');
    }    
    
    #[Route('/back/faq', name: 'back_faq')]
    public function faq(): Response
    {
        return $this->render('Template_Back/faq.html.twig');
    }    
    
    #[Route('/back/forms', name: 'back_forms')]
    public function forms(): Response
    {
        return $this->render('Template_Back/forms.html.twig');
    }

    #[Route('/back/login', name: 'back_login')]
    public function login(): Response
    {
        return $this->render('Template_Back/login.html.twig');
    }

    #[Route('/back/profile', name: 'back_profile')]
    public function profile(): Response
    {
        return $this->render('Template_Back/profile.html.twig');
    }

    #[Route('/back/register', name: 'back_register')]
    public function register(): Response
    {
        return $this->render('Template_Back/register.html.twig');
    }

    #[Route('/back/tablesdata', name: 'back_tablesdata')]
    public function tablesdata(): Response
    {
        return $this->render('Template_Back/tablesdata.html.twig');
    }

    #[Route('/back/tablesgeneral', name: 'back_tablesgeneral')]
    public function tablesgeneral(): Response
    {
        return $this->render('Template_Back/tablesgeneral.html.twig');
    }
}
