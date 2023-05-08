<?php

namespace App\Controller;

use App\Entity\Plannification;
use App\Service\QRCodeService;
use ContainerJA2Xfg6\getPlannificationControllerService;
use Dompdf\Dompdf;
use App\Form\PlannificationType;
use App\Repository\PlannificationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Options;
use Endroid\QrCode\QrCode;


class PDFplannificationController extends AbstractController
{
    #[Route('/generate-plannification-pdf/{id}', name: 'app_generateplannification_pdf')]
    public function generatePdf($id,QRCodeService $QRCodeService)
    {
        $qrCode= $QRCodeService->qrcode($id);
        // Récupérer la plannification à afficher en PDF
        $plannification = $this->getDoctrine()->getRepository(Plannification::class)->find($id);

        // Créer une instance de Dompdf
        $dompdf = new Dompdf();

        // Générer le HTML à partir d'un template Twig
        $html = $this->renderView('pdf/plannification.html.twig', [
            'plannification' => $plannification,
            'qrCode'=>$qrCode
        ]);

        // Charger le HTML dans Dompdf
        $dompdf->loadHtml($html);

        // Rendre le PDF
        $dompdf->render();

        // Renvoyer le PDF au navigateur
        return new Response($dompdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="plannification.pdf"'
        ]);
    }
    #[Route('/generate-pdfplannification-all', name: 'app_generateplannification_pdf_all')]
    public function generatePdfAction()
    {
        $plannifications = $this->getDoctrine()
            ->getRepository(Plannification::class)
            ->findAll();
        // Créer une instance de Dompdf
        $dompdf = new Dompdf();

        // Générer le HTML à partir d'un template Twig
        $html = $this->renderView('pdf/plannificationAll.html.twig', [
            'plannifications' => $plannifications
        ]);

        // Charger le HTML dans Dompdf
        $dompdf->loadHtml($html);

        // Rendre le PDF
        $dompdf->render();

        // Renvoyer le PDF au navigateur
        return new Response($dompdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="plannifications.pdf"'
        ]);
    }

}
