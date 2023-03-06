<?php

namespace App\Controller;

use App\Entity\Historique;
use App\Entity\Rendezvous;
use App\Form\RendezvousType;
use App\Repository\UtilisateurRepository;
use App\Repository\HistoriqueRepository;
use App\Repository\RendezvousRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class RendezvousController extends AbstractController
{

    #[Route('/back/rendezvous/', name: 'back_rendezvous_index', methods: ['GET'])]
    public function backIndex(RendezvousRepository $rendezvousRepository): Response
    {
        $now = new \DateTime;
        return $this->render('rendezvous/back/index.html.twig', [
            'rendezvous' => $rendezvousRepository->getRendezvous($now),
            'Historique' => $rendezvousRepository->getOldRendezvous($now),
        ]);
    }

    #[Route('/back/rendezvous/new', name: 'back_rendezvous_new', methods: ['GET', 'POST'])]
    public function backNew(Request $request, RendezvousRepository $rendezvousRepository, HistoriqueRepository $historiqueRepository, UtilisateurRepository $userRepository): Response
    {
        $userId = 2;

        $rendezvous = new Rendezvous();
        $form = $this->createForm(RendezvousType::class, $rendezvous);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $rendezvousRepository->save($rendezvous, true);
            $historique = new Historique();
            $historiqueRepository->save($historique->createHistorique("Rendez-vous " . $rendezvous->getId() . " créé", $userId, $userRepository), true);
            return $this->redirectToRoute('back_rendezvous_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rendezvous/back/new.html.twig', [
            'rendezvous' => $rendezvous,
            'form' => $form,
        ]);
    }

    #[Route('back/rendezvous/edit/{id}', name: 'back_rendezvous_edit', methods: ['GET', 'POST'])]
    public function backEdit(Request $request, Rendezvous $rendezvous, RendezvousRepository $rendezvousRepository, HistoriqueRepository $historiqueRepository, UtilisateurRepository $userRepository): Response
    {
        $userId = 2;
        $form = $this->createForm(RendezvousType::class, $rendezvous);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rendezvousRepository->save($rendezvous, true);
            $historique = new Historique();
            $historiqueRepository->save($historique->createHistorique("Rendez-vous ". $rendezvous->getId() . " modifié", $userId, $userRepository), true);
            return $this->redirectToRoute('back_rendezvous_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rendezvous/back/edit.html.twig', [
            'rendezvous' => $rendezvous,
            'form' => $form,
        ]);
    }

    #[Route('back/rendezvous/delete/{id}', name: 'back_rendezvous_delete', methods: ['POST'])]
    public function backDelete(Request $request, Rendezvous $rendezvous, RendezvousRepository $rendezvousRepository, HistoriqueRepository $historiqueRepository, UtilisateurRepository $userRepository): Response
    {
        $userId = 2;
        if ($this->isCsrfTokenValid('delete'.$rendezvous->getId(), $request->request->get('_token'))) {
            $id = $rendezvous->getId();
            $rendezvousRepository->remove($rendezvous, true);
            $historique = new Historique();
            $historiqueRepository->save($historique->createHistorique("Rendez-vous ". $id . " supprimé", $userId, $userRepository), true);
        }

        return $this->redirectToRoute('back_rendezvous_index', [], Response::HTTP_SEE_OTHER);
    }





    #[Route('/rendezvous', name: 'front_rendezvous_index', methods: ['GET'])]
    public function frontIndex(RendezvousRepository $rendezvousRepository): Response
    {
        // $userId = $session->get('userId');
        $userId = 2;
        $now = new \DateTime();
        
        return $this->render('rendezvous/front/index.html.twig', [
            'rendezvous' => $rendezvousRepository->getRendezvousByUser($now, $userId),
        ]);
    }

    #[Route('/rendezvous/new', name: 'front_rendezvous_new', methods: ['GET', 'POST'])]
    public function frontNew(Request $request, RendezvousRepository $rendezvousRepository, HistoriqueRepository $historiqueRepository, UtilisateurRepository $userRepository): Response
    {
        $userId = 2;
        $rendezvous = new Rendezvous();
        $form = $this->createForm(RendezvousType::class, $rendezvous);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rendezvousRepository->save($rendezvous, true);
            $historique = new Historique();
            $historiqueRepository->save($historique->createHistorique("Rendez-vous " . $rendezvous->getId() . " créé", $userId, $userRepository), true);
            return $this->redirectToRoute('front_rendezvous_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rendezvous/front/new.html.twig', [
            'rendezvous' => $rendezvous,
            'form' => $form,
        ]);
    }

    #[Route('rendezvous/edit/{id}', name: 'front_rendezvous_edit', methods: ['GET', 'POST'])]
    public function frontEdit(Request $request, Rendezvous $rendezvous, RendezvousRepository $rendezvousRepository, HistoriqueRepository $historiqueRepository, UtilisateurRepository $userRepository): Response
    {
        $userId = 2;
        $form = $this->createForm(RendezvousType::class, $rendezvous);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rendezvousRepository->save($rendezvous, true);
            $historique = new Historique();
            $historiqueRepository->save($historique->createHistorique("Rendez-vous ". $rendezvous->getId() . " modifié", $userId, $userRepository), true);
            return $this->redirectToRoute('front_rendezvous_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rendezvous/front/edit.html.twig', [
            'rendezvous' => $rendezvous,
            'form' => $form,
        ]);
    }

    #[Route('rendezvous/delete/{id}', name: 'front_rendezvous_delete', methods: ['POST'])]
    public function frontDelete(Request $request, Rendezvous $rendezvous, RendezvousRepository $rendezvousRepository, HistoriqueRepository $historiqueRepository, UtilisateurRepository $userRepository): Response
    {
        $userId = 2;
        if ($this->isCsrfTokenValid('delete'.$rendezvous->getId(), $request->request->get('_token'))) {
            $id = $rendezvous->getId();
            $rendezvousRepository->remove($rendezvous, true);
            $historique = new Historique();
            $historiqueRepository->save($historique->createHistorique("Rendez-vous ". $id . " supprimé", $userId, $userRepository), true);
        }

        return $this->redirectToRoute('front_rendezvous_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('back/rendezvous/clear/{param}', name: 'rendezvous_historique', methods: ['GET', 'POST'])]
    public function clearHistorique(RendezvousRepository $rendezvousRepository, $param = 0)
    {
        $date = new \DateTime("-1 months");

        $ids = array_map(function ($rendezvous) {
            return $rendezvous->getId();
        }, $rendezvousRepository->getOldRendezvous($date));

        if ($param) {
            // Get the current date to clear everything
            $date = new \DateTime();
        }

        return new JsonResponse(['id' => $ids, 'success' => $rendezvousRepository->clearOldRendezvous($date)]);
    }

    

    #[Route('back/rendezvous/calendar', name: 'back_rendezvous_calendar', methods: ['GET'])]
    public function rendezvousCalender() : Response
    {
        return $this->render('rendezvous/back/calendar.html.twig');
    }

    #[Route('back/rendezvous/search', name: 'rendezvous_search', methods: ['POST'])]
    public function searchRendezvous(Request $request, RendezvousRepository $rendezvousRepository) : Response
    {
        return $this->render('rendezvous/_search.html.twig', [
            'rendezvous' => $rendezvousRepository->searchRendezvousByUser($request->request->get('value')),
        ]);
    }

}