<?php

namespace App\Controller;

use ContainerJA2Xfg6\getPlannificationControllerService;
use Dompdf\Dompdf;
use App\Entity\Plannification;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Options;

class PDFController extends AbstractController
{
    #[Route('/generate-pdf/{id}', name: 'app_generate_pdf')]
    public function generatePdf($id)
    {
        // Récupérer la plannification à afficher en PDF
        $plannification = $this->getDoctrine()->getRepository(Plannification::class)->find($id);

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
            'Content-Disposition' => 'inline; filename="plannification.pdf"'
        ]);
    }
    #[Route('/generate-pdf-all', name: 'app_generate_pdf_all')]
    public function generatePdfAction()
    {
        $em = $this->getDoctrine()->getManager();
        $plannification = $em->getRepository(Plannification::class)->findAll();

        $html = $this->renderView('pdf/plannificationAll.html.twig', [
            'plannifications' => $plannification,
        ]);

        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        $dompdf = new Dompdf($pdfOptions);
        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        $dompdf->stream("plannification_list.pdf", [
            "Attachment" => false
        ]);
    }
}
