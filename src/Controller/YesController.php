<?php

namespace App\Controller;

use App\Entity\Categoriesequipement;
use App\Form\CategoriesequipementType;
use App\Repository\CategoriesequipementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/yes')]
class YesController extends AbstractController
{
    #[Route('/', name: 'app_yes_index', methods: ['GET'])]
    public function index(CategoriesequipementRepository $categoriesequipementRepository): Response
    {
        return $this->render('yes/index.html.twig', [
            'categoriesequipements' => $categoriesequipementRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_yes_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CategoriesequipementRepository $categoriesequipementRepository): Response
    {
        $categoriesequipement = new Categoriesequipement();
        $form = $this->createForm(CategoriesequipementType::class, $categoriesequipement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categoriesequipementRepository->save($categoriesequipement, true);

            return $this->redirectToRoute('app_yes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('yes/new.html.twig', [
            'categoriesequipement' => $categoriesequipement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_yes_show', methods: ['GET'])]
    public function show(Categoriesequipement $categoriesequipement): Response
    {
        return $this->render('yes/show.html.twig', [
            'categoriesequipement' => $categoriesequipement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_yes_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Categoriesequipement $categoriesequipement, CategoriesequipementRepository $categoriesequipementRepository): Response
    {
        $form = $this->createForm(CategoriesequipementType::class, $categoriesequipement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categoriesequipementRepository->save($categoriesequipement, true);

            return $this->redirectToRoute('app_yes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('yes/edit.html.twig', [
            'categoriesequipement' => $categoriesequipement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_yes_delete', methods: ['POST'])]
    public function delete(Request $request, Categoriesequipement $categoriesequipement, CategoriesequipementRepository $categoriesequipementRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categoriesequipement->getId(), $request->request->get('_token'))) {
            $categoriesequipementRepository->remove($categoriesequipement, true);
        }

        return $this->redirectToRoute('app_yes_index', [], Response::HTTP_SEE_OTHER);
    }
}
