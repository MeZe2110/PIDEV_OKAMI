<?php

namespace App\Controller;

use App\Entity\Historique;
use App\Form\HistoriqueType;
use App\Repository\HistoriqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/back/historique')]
class HistoriqueController extends AbstractController
{
    #[Route('/', name: 'back_historique_index', methods: ['GET'])]
    public function index(HistoriqueRepository $historiqueRepository): Response
    {
        return $this->render('historique/index.html.twig', [
            'historiques' => $historiqueRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'back_historique_delete', methods: ['POST'])]
    public function delete(Request $request, Historique $historique, HistoriqueRepository $historiqueRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$historique->getId(), $request->request->get('_token'))) {
            $historiqueRepository->remove($historique, true);
        }

        return $this->redirectToRoute('back_historique_index', [], Response::HTTP_SEE_OTHER);
    }
}
