<?php

namespace App\Controller;

use App\Entity\Plannification;
use App\Form\PlannificationType;
use App\Repository\PlannificationRepository;
use App\Services\QRCodeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Response\QrCodeResponse;
use Endroid\QrCode\Writer;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

#[Route('/plannification')]
class PlannificationController extends AbstractController
{
    #[Route('/', name: 'app_plannification_index', methods: ['GET'])]
    public function index(Request $request): Response
    {
        $sort = $request->query->get('sort', 'desc');
        $search = $request->query->get('search');

        if ($search) {
            $plannifications = $this->getDoctrine()
                ->getRepository(Plannification::class)
                ->findBySearch($search);
        } else {
            $plannifications = $this->getDoctrine()
                ->getRepository(Plannification::class)
                ->findBy([], ['datepl' => $sort]);
        }

        return $this->render('plannification/index.html.twig', [
            'plannifications' => $plannifications,
        ]);
    }

    #[Route('/front', name: 'app_plannification_front', methods: ['GET'])]
    public function front(PlannificationRepository $plannificationRepository): Response
    {
        return $this->render('plannification/front.html.twig', [
            'plannifications' => $plannificationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_plannification_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PlannificationRepository $plannificationRepository): Response
    {
        $plannification = new Plannification();
        $form = $this->createForm(PlannificationType::class, $plannification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plannificationRepository->save($plannification, true);

            return $this->redirectToRoute('app_plannification_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('plannification/new.html.twig', [
            'plannification' => $plannification,
            'form' => $form,
        ]);
    }

    #[Route('/statistique', name: 'app_plannification_statistique', methods: ['GET'])]
    public function statistique(Request $request): Response
    {
        $sort = $request->query->get('sort', 'desc');
        $search = $request->query->get('search');

        if ($search) {
            $plannifications = $this->getDoctrine()
                ->getRepository(Plannification::class)
                ->findBySearch($search);
        } else {
            $plannifications = $this->getDoctrine()
                ->getRepository(Plannification::class)
                ->findBy([], ['datepl' => $sort]);
        }

        return $this->render('plannification/statistique.html.twig', [
            'plannifications' => $plannifications,
        ]);
    }

    #[Route('/{id}', name: 'app_plannification_show', methods: ['GET'])]
    public function show(Plannification $plannification): Response
    {


        return $this->render('plannification/show.html.twig', [
            'plannification' => $plannification
        ]);
    }

    #[Route('/{id}/edit', name: 'app_plannification_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Plannification $plannification, PlannificationRepository $plannificationRepository): Response
    {
        $form = $this->createForm(PlannificationType::class, $plannification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plannificationRepository->save($plannification, true);

            return $this->redirectToRoute('app_plannification_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('plannification/edit.html.twig', [
            'plannification' => $plannification,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_plannification_delete', methods: ['POST'])]
    public function delete(Request $request, Plannification $plannification, PlannificationRepository $plannificationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$plannification->getId(), $request->request->get('_token'))) {
            $plannificationRepository->remove($plannification, true);
        }

        return $this->redirectToRoute('app_plannification_index', [], Response::HTTP_SEE_OTHER);
    }
    /*public function generateQrCode()
    {
        $qrCode = new QrCode('Hello, world!');
        $qrCode->setWriter('png');
        $qrCodeData = $qrCode->writeString();
        $response = new Response($qrCodeData);
        $response->headers->set('Content-Type', $qrCode->getContentType());
        return $response;
    }*/

}
