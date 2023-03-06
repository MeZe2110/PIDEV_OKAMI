<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    #[Route('', name: 'front_base')]
    #[Route('/index', name: 'front_index')]
    public function index(): Response
    {
        return $this->render('Template_Front/index.html.twig');
    }

    #[Route('/about', name: 'front_about')]
    public function about(): Response
    {
        return $this->render('Template_Front/about.html.twig');
    }

    #[Route('/departments', name: 'front_departments')]
    public function departments(): Response
    {
        return $this->render('Template_Front/departments.html.twig');
    }

    #[Route('/doctors', name: 'front_doctors')]
    public function doctors(): Response
    {
        return $this->render('Template_Front/doctors.html.twig');
    }

    #[Route('/contact', name: 'front_contact')]
    public function contact(): Response
    {
        return $this->render('Template_Front/contact.html.twig');
    }

}
