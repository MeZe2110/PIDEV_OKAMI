<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AcceuilController extends AbstractController
{
    #[Route('/front_index', name: 'front_index')]
    public function index(): Response
    {
        return $this->render('Template_Front/index.html.twig');
    }

    #[Route('/front_about', name: 'front_about')]
    public function about(): Response
    {
        return $this->render('Template_Front/about.html.twig');
    }

    #[Route('/front_departments', name: 'front_departments')]
    public function departments(): Response
    {
        return $this->render('Template_Front/departments.html.twig');
    }

    #[Route('/front_doctors', name: 'front_doctors')]
    public function doctors(): Response
    {
        return $this->render('Template_Front/doctors.html.twig');
    }

    #[Route('/front_contact', name: 'front_contact')]
    public function contact(): Response
    {
        return $this->render('Template_Front/contact.html.twig');
    }

}
