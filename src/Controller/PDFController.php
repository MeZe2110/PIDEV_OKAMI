<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use ContainerJA2Xfg6\getPlannificationControllerService;
use Dompdf\Dompdf;
use App\Entity\Vehicules;
use App\Form\VehiculesType;
use App\Repository\VehiculesRepository;
use Dompdf\Options;
use Endroid\QrCode\QrCode;

class PDFController extends AbstractController
{
    #[Route('/generate-vehicule-pdf/{id}', name: 'app_generatevehicule_pdf')]
    public function generatePdf($id)
    {
        // Récupérer la plannification à afficher en PDF
        $plannification = $this->getDoctrine()->getRepository(Vehicules::class)->find($id);

        // Créer une instance de Dompdf
        $dompdf = new Dompdf();

        // Générer le HTML à partir d'un template Twig
        $html = $this->renderView('pdf/plannification.html.twig', [
            'plannification' => $plannification
        ]);

        // Charger le HTML dans Dompdf
        $dompdf->loadHtml($html);

        // Rendre le PDF
        $dompdf->render();

        // Renvoyer le PDF au navigateur
        return new Response($dompdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="vehicules.pdf"'
        ]);
    }
    #[Route('/generate-vehicule-pdf-all', name: 'app_generatevehicule_pdf_all')]
    public function generatePdfAction()
    {
        $vehicules = $this->getDoctrine()
            ->getRepository(Vehicules::class)
            ->findAll();
        // Créer une instance de Dompdf
        $dompdf = new Dompdf();

        // Générer le HTML à partir d'un template Twig
        $html = $this->renderView('pdf/index.html.twig', [
            'vehicules' => $vehicules
        ]);

        // Charger le HTML dans Dompdf
        $dompdf->loadHtml($html);

        // Rendre le PDF
        $dompdf->render();

        // Renvoyer le PDF au navigateur
        return new Response($dompdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="vehicule.pdf"'
        ]);
    }

}
