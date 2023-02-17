<?php

namespace App\Controller;

use App\Entity\Rendezvous;
use App\Form\RendezvousType;
use App\Repository\RendezvousRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/rendezvous')]
class RendezvousController extends AbstractController
{
    #[Route('/', name: 'rendezvous_index', methods: ['GET'])]
    public function index(EntityManagerInterface $em): Response
    {
        $qb = $em->createQueryBuilder();
        $RendezvousAndUtilisateur = $qb
            ->select('r, Utilisateur')
            ->from(Rendezvous::class, 'r')
            ->leftJoin('r.Utilisateur', 'Utilisateur')
            ->getQuery()
            ->getResult();

        return $this->render('rendezvous/index.html.twig', [
            'RendezvousAndUtilisateur' => $RendezvousAndUtilisateur,
        ]);
    }

    #[Route('/new', name: 'rendezvous_new', methods: ['GET', 'POST'])]
    public function new(Request $request, RendezvousRepository $rendezvousRepository): Response
    {
        $rendezvous = new Rendezvous();
        $form = $this->createForm(RendezvousType::class, $rendezvous);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rendezvousRepository->save($rendezvous, true);

            return $this->redirectToRoute('rendezvous_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rendezvous/new.html.twig', [
            'rendezvous' => $rendezvous,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'rendezvous_show', methods: ['GET'])]
    public function show(Rendezvous $rendezvous): Response
    {
        return $this->render('rendezvous/show.html.twig', [
            'rendezvous' => $rendezvous,
        ]);
    }

    #[Route('/{id}/edit', name: 'rendezvous_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Rendezvous $rendezvous, RendezvousRepository $rendezvousRepository): Response
    {
        $form = $this->createForm(RendezvousType::class, $rendezvous);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rendezvousRepository->save($rendezvous, true);

            return $this->redirectToRoute('rendezvous_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rendezvous/edit.html.twig', [
            'rendezvous' => $rendezvous,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'rendezvous_delete', methods: ['POST'])]
    public function delete(Request $request, Rendezvous $rendezvous, RendezvousRepository $rendezvousRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rendezvous->getId(), $request->request->get('_token'))) {
            $rendezvousRepository->remove($rendezvous, true);
        }

        return $this->redirectToRoute('rendezvous_index', [], Response::HTTP_SEE_OTHER);
    }
}
