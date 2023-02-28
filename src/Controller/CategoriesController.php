<?php

namespace App\Controller;

use App\Entity\Stockcategories;
use App\Form\StockcategoriesType;
use App\Repository\StockcategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/categories')]
class CategoriesController extends AbstractController
{
    #[Route('/', name: 'app_categories_index', methods: ['GET'])]
    public function index(StockcategoriesRepository $stockcategoriesRepository): Response
    {
        return $this->render('categories/index.html.twig', [
            'stockcategories' => $stockcategoriesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_categories_new', methods: ['GET', 'POST'])]
    public function new(Request $request, StockcategoriesRepository $stockcategoriesRepository): Response
    {
        $stockcategory = new Stockcategories();
        $form = $this->createForm(StockcategoriesType::class, $stockcategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $stockcategoriesRepository->save($stockcategory, true);

            return $this->redirectToRoute('app_categories_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categories/new.html.twig', [
            'stockcategory' => $stockcategory,
            'form' => $form,
        ]);
    }

   

    #[Route('/{id}/edit', name: 'app_categories_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Stockcategories $stockcategory, StockcategoriesRepository $stockcategoriesRepository): Response
    {
        $form = $this->createForm(StockcategoriesType::class, $stockcategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $stockcategoriesRepository->save($stockcategory, true);

            return $this->redirectToRoute('app_categories_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categories/edit.html.twig', [
            'stockcategory' => $stockcategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_categories_delete', methods: ['POST'])]
    public function delete(Request $request, Stockcategories $stockcategory, StockcategoriesRepository $stockcategoriesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$stockcategory->getId(), $request->request->get('_token'))) {
            $stockcategoriesRepository->remove($stockcategory, true);
        }

        return $this->redirectToRoute('app_categories_index', [], Response::HTTP_SEE_OTHER);
    }
}
