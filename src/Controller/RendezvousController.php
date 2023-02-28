<?php

namespace App\Controller;

use App\Entity\Rendezvous;
use App\Form\RendezvousType;
use App\Repository\RendezvousRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class RendezvousController extends AbstractController
{
    #[Route('/back/rendezvous/', name: 'back_rendezvous_index', methods: ['GET'])]
    public function backIndex(RendezvousRepository $rendezvousRepository): Response
    {
        $RendezvousAndUtilisateur = $rendezvousRepository->createQueryBuilder('r')
            ->select('r')
            ->leftJoin('r.Utilisateur', 'Utilisateur')
            ->getQuery()
            ->getResult();

        return $this->render('rendezvous/back/index.html.twig', [
            'RendezvousAndUtilisateur' => $RendezvousAndUtilisateur,
        ]);
    }

    #[Route('/back/rendezvous/new', name: 'back_rendezvous_new', methods: ['GET', 'POST'])]
    public function backNew(Request $request, RendezvousRepository $rendezvousRepository): Response
    {
        $rendezvous = new Rendezvous();
        $form = $this->createForm(RendezvousType::class, $rendezvous);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rendezvousRepository->save($rendezvous, true);

            return $this->redirectToRoute('back_rendezvous_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rendezvous/back/new.html.twig', [
            'rendezvous' => $rendezvous,
            'form' => $form,
        ]);
    }

    #[Route('back/rendezvous/edit/{id}', name: 'back_rendezvous_edit', methods: ['GET', 'POST'])]
    public function backEdit(Request $request, Rendezvous $rendezvous, RendezvousRepository $rendezvousRepository): Response
    {
        $form = $this->createForm(RendezvousType::class, $rendezvous);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rendezvousRepository->save($rendezvous, true);

            return $this->redirectToRoute('back_rendezvous_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rendezvous/back/edit.html.twig', [
            'rendezvous' => $rendezvous,
            'form' => $form,
        ]);
    }

    #[Route('back/rendezvous/delete/{id}', name: 'back_rendezvous_delete', methods: ['POST'])]
    public function backDelete(Request $request, Rendezvous $rendezvous, RendezvousRepository $rendezvousRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rendezvous->getId(), $request->request->get('_token'))) {
            $rendezvousRepository->remove($rendezvous, true);
        }

        return $this->redirectToRoute('back_rendezvous_index', [], Response::HTTP_SEE_OTHER);
    }





    #[Route('/rendezvous', name: 'front_rendezvous_index', methods: ['GET'])]
    public function frontIndex(RendezvousRepository $rendezvousRepository): Response
    {
        // $userId = $session->get('userId');
        $userId = 2;
        $RendezvousAndUtilisateur = $rendezvousRepository->createQueryBuilder('r')
            ->select('r')
            ->where('Utilisateur.id = :userId')
            ->setParameter('userId', $userId)
            ->leftJoin('r.Utilisateur', 'Utilisateur')
            ->getQuery()
            ->getResult();

        return $this->render('rendezvous/front/index.html.twig', [
            'RendezvousAndUtilisateur' => $RendezvousAndUtilisateur,
        ]);
    }

    #[Route('/rendezvous/new', name: 'front_rendezvous_new', methods: ['GET', 'POST'])]
    public function frontNew(Request $request, RendezvousRepository $rendezvousRepository): Response
    {
        $rendezvous = new Rendezvous();
        $form = $this->createForm(RendezvousType::class, $rendezvous);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rendezvousRepository->save($rendezvous, true);

            return $this->redirectToRoute('front_rendezvous_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rendezvous/front/new.html.twig', [
            'rendezvous' => $rendezvous,
            'form' => $form,
        ]);
    }

    #[Route('rendezvous/edit/{id}', name: 'front_rendezvous_edit', methods: ['GET', 'POST'])]
    public function frontEdit(Request $request, Rendezvous $rendezvous, RendezvousRepository $rendezvousRepository): Response
    {
        $form = $this->createForm(RendezvousType::class, $rendezvous);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rendezvousRepository->save($rendezvous, true);

            return $this->redirectToRoute('front_rendezvous_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rendezvous/front/edit.html.twig', [
            'rendezvous' => $rendezvous,
            'form' => $form,
        ]);
    }

    #[Route('rendezvous/delete/{id}', name: 'front_rendezvous_delete', methods: ['POST'])]
    public function frontDelete(Request $request, Rendezvous $rendezvous, RendezvousRepository $rendezvousRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rendezvous->getId(), $request->request->get('_token'))) {
            $rendezvousRepository->remove($rendezvous, true);
        }

        return $this->redirectToRoute('front_rendezvous_index', [], Response::HTTP_SEE_OTHER);
    }




}