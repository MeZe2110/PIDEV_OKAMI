<?php

namespace App\Controller;

use App\Entity\Stock;
use App\Form\StockType;
use App\Repository\StockRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/stockc')]
class StockcController extends AbstractController
{
    #[Route('/', name: 'app_stockc_index', methods: ['GET'])]
    public function index(Request $request): Response
    {
      

     
        $search = $request->query->get('search');

        if ($search) {
            $stocks = $this->getDoctrine()
                ->getRepository(Stock::class)
                ->findBySearch($search);
        } else {
            $stocks = $this->getDoctrine()
                ->getRepository(stock::class)
                ->findAll();
        }
        $sort = $request->query->get('sort');

        $stocks = $this->getDoctrine()
        ->getRepository(Stock::class)
        ->findBy([nomst], [$sort => 'ASC']);



        return $this->render('stockc/index.html.twig', [
            'stocks' => $stocks,
        ]);

    }
   

    #[Route('/f', name: 'app_stockc', methods: ['GET'])]
    public function aaa(StockRepository $stockRepository): Response
    {
        return $this->render('stockc/index_front.html.twig', [
            'stocks' => $stockRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_stockc_new', methods: ['GET', 'POST'])]
    public function new(Request $request, StockRepository $stockRepository): Response
    {// le formulaire a été soumis
        $stock = new Stock();
        $form = $this->createForm(StockType::class, $stock);
        $form->handleRequest($request);
      //enregistrer les données dans une base de données
        if ($form->isSubmitted() && $form->isValid()) {
            $stockRepository->save($stock, true);

            return $this->redirectToRoute('app_stockc_index' );
        }

        return $this->renderForm('stockc/new.html.twig', [
            'stock' => $stock,
            'form' => $form,
        ]);
    }

    

    #[Route('/{id}/edit', name: 'app_stockc_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Stock $stock, StockRepository $stockRepository): Response
    {
        $form = $this->createForm(StockType::class, $stock);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $stockRepository->save($stock, true);

            return $this->redirectToRoute('app_stockc_index');
        }

        return $this->renderForm('stockc/edit.html.twig', [
            'stock' => $stock,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_stockc_delete', methods: ['POST'])]
    public function suppc(ManagerRegistry $doctrine,$id,StockRepository $repository)
      {     //recuperer le stock a supprimer
           $stock=$repository->find($id);
           //recuperer l'entity manager
           $em= $doctrine->getManager();
           $em->remove($stock);
           $em->flush();
        return $this->redirectToRoute('app_stockc_index');
    }
}
