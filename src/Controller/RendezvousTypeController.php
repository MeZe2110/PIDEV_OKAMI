<?php

namespace App\Controller;

use App\Entity\RendezvousType;
use App\Form\RendezvousTypeType;
use App\Repository\RendezvousTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/back/rendezvous/type')]
class RendezvousTypeController extends AbstractController
{
    #[Route('/', name: 'back_rendezvous_type_index', methods: ['GET'])]
    public function index(RendezvousTypeRepository $rendezvousTypeRepository): Response
    {
        return $this->render('rendezvous/back/type/index.html.twig', [
            'rendezvous_types' => $rendezvousTypeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'back_rendezvous_type_new', methods: ['GET', 'POST'])]
    public function new(Request $request, RendezvousTypeRepository $rendezvousTypeRepository): Response
    {
        $rendezvousType = new RendezvousType();
        $form = $this->createForm(RendezvousTypeType::class, $rendezvousType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rendezvousTypeRepository->save($rendezvousType, true);

            return $this->redirectToRoute('back_rendezvous_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rendezvous/back/type/new.html.twig', [
            'rendezvous_type' => $rendezvousType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'back_rendezvous_type_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, RendezvousType $rendezvousType, RendezvousTypeRepository $rendezvousTypeRepository): Response
    {
        $form = $this->createForm(RendezvousTypeType::class, $rendezvousType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rendezvousTypeRepository->save($rendezvousType, true);

            return $this->redirectToRoute('back_rendezvous_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rendezvous/back/type/edit.html.twig', [
            'rendezvous_type' => $rendezvousType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'back_rendezvous_type_delete', methods: ['POST'])]
    public function delete(Request $request, RendezvousType $rendezvousType, RendezvousTypeRepository $rendezvousTypeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rendezvousType->getId(), $request->request->get('_token'))) {
            $rendezvousTypeRepository->remove($rendezvousType, true);
        }

        return $this->redirectToRoute('back_rendezvous_type_index', [], Response::HTTP_SEE_OTHER);
    }
}
