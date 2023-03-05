<?php

namespace App\Controller;

use App\Entity\Stock;
use ContainerJA2Xfg6\getPdfstockControllerService;
use Dompdf\Dompdf;
use App\Form\StockType;
use App\Repository\StockRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Options;
use Endroid\QrCode\QrCode;

class PdfstockController extends AbstractController
{
    #[Route('/generate-pdf/{id}/edit', name: 'app_generate_pdf')]
    public function generatePdf($id)
    {
        // Récupérer la plannification à afficher en PDF
        $stock = $this->getDoctrine()->getRepository(Stock::class)->find($id);

        // Créer une instance de Dompdf
        $dompdf = new Dompdf();

        // Générer le HTML à partir d'un template Twig
        $html = $this->renderView('pdfstock/index.html.twig', [
            'stock' => $stock
        ]);

        // Charger le HTML dans Dompdf
        $dompdf->loadHtml($html);

        // Rendre le PDF
        $dompdf->render();

        // Renvoyer le PDF au navigateur
        return new Response($dompdf->output(), 200, [
            'Content-Type' => 'application/pdfstock',
            'Content-Disposition' => 'inline; filename="stock.pdf"'
        ]);
    }
    #[Route('/generate-pdf-all', name: 'app_generate_pdf_all')]
    public function generatePdfAction()
    {
        $stocks = $this->getDoctrine()
            ->getRepository(Stock::class)
            ->findAll();
        // Créer une instance de Dompdf
        $dompdf = new Dompdf();

        // Générer le HTML à partir d'un template Twig
        $html = $this->renderView('pdfstock/stockall.html.twig', [
            'stocks' => $stocks
        ]);

        // Charger le HTML dans Dompdf
        $dompdf->loadHtml($html);

        // Rendre le PDF
        $dompdf->render();

        // Renvoyer le PDF au navigateur
        return new Response($dompdf->output(), 200, [
            'Content-Type' => 'application/pdfstock',
            'Content-Disposition' => 'inline; filename="stocks.pdf"'
        ]);
    }

}
