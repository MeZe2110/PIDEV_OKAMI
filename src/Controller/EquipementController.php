<?php

namespace App\Controller;

use App\Entity\Equipement;
use App\Form\EquipementType;
use App\Repository\EquipementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

#[Route('/equipement')]
class EquipementController extends AbstractController
{
    #[Route('/', name: 'app_equipement_index', methods: ['GET'])]
    public function index(EquipementRepository $equipementRepository): Response
    {

        return $this->render('equipement/index.html.twig',[ 'equipements' => $equipementRepository->findAll()]);
    }

    #[Route('/search', name: 'search')]
    public function search(Request $request, EquipementRepository $repository): Response
    {
        $value = $request->request->get('value');
        $equipement = $repository->searchBynom($value);
        return $this->render('equipement/search.html.twig', [
            'equipements' => $equipement
        ]);
    }

    #[Route('/Stats', name: 'app_statistique',methods: ['GET'])]
    public function statsequipe(EquipementRepository $equipementRepository)
    {
        $counts = $equipementRepository->countBy('etateq');
        dump($counts) ;
        $countsD = $equipementRepository->countByDispo('dispoeq');
        dump($countsD) ;
        return $this->render('equipement/stats.html.twig', [
            'equipements' => $equipementRepository->findAll(),
            'counts' => $counts,
            'countsD' => $countsD,

        ]);
    }

    #[Route('/front', name: 'app_equipement_front', methods: ['GET'])]
    public function front(EquipementRepository $equipementRepository): Response
    {
        return $this->render('equipement/showAll.html.twig', [
            'equipements' => $equipementRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_equipement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EquipementRepository $equipementRepository): Response
    {
        $equipement = new Equipement();
        $form = $this->createForm(EquipementType::class, $equipement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $equipementRepository->save($equipement, true);

            return $this->redirectToRoute('app_equipement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('equipement/new.html.twig', [
            'equipement' => $equipement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_equipement_show', methods: ['GET'])]
    public function show(Equipement $equipement): Response
    {
        return $this->render('equipement/show.html.twig', [
            'equipement' => $equipement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_equipement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Equipement $equipement, EquipementRepository $equipementRepository): Response
    {
        $form = $this->createForm(EquipementType::class, $equipement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $equipementRepository->save($equipement, true);

            return $this->redirectToRoute('app_equipement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('equipement/edit.html.twig', [
            'equipement' => $equipement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_equipement_delete', methods: ['POST'])]
    public function delete(Request $request, Equipement $equipement, EquipementRepository $equipementRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$equipement->getId(), $request->request->get('_token'))) {
            $equipementRepository->remove($equipement, true);
        }

        return $this->redirectToRoute('app_equipement_index', [], Response::HTTP_SEE_OTHER);
    }

}
