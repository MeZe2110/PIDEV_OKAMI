<?php

namespace App\Controller;

use App\Entity\Stock;
use App\Form\StockType;
use App\Repository\StockRepository;
use App\Repository\StockcategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\NotifierInterface;
use PHPMailer\PHPMailer\PHPMailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle;
use App\Service\AjoutNotificationService;


class StockcController extends AbstractController
{
   

    #[Route('/f', name: 'app_stockc', methods: ['GET'])]
    public function index_front(Request $request,StockcategoriesRepository $StockcategoriesRepository,StockRepository $stockRepository): Response
    {
        $search = $request->query->get('search');
        if ($search) {
            $stocks = $this->getDoctrine()
                ->getRepository(Stock::class)
                ->findBySearch($search);
        } else {
            $stocks = $this->getDoctrine()
                ->getRepository(stock::class)
                ->findBy([], ['nomst' => 'ASC']);
        }
        
        return $this->render('stockc/index_front.html.twig', [
            'stocks' => $stocks,
            'categories' => $StockcategoriesRepository->findAll(),
            
        ]);
    }

#[Route('/filtrer-front', name:'app_medicament_filtrer_front', methods: ['POST'])]
public function filtrerFront(StockcategoriesRepository $StockcategoriesRepository, Request $request)
{                
    $selectedValue = $request->request->get('category');

    $stocks = $this->getDoctrine()
        ->getRepository(Stock::class)
        ->createQueryBuilder('m')
        ->where('m.stockcat = :query')
        ->setParameter('query', $selectedValue)
        ->getQuery()
        ->getResult();
    
    return $this->render('stockc/index_front.html.twig', [
        'stocks' => $stocks,
        'categories' => $StockcategoriesRepository->findAll(),
    ]);
   }

   #[Route('/front/{id}', name: 'app_stock_showfront' )]
            public function showfront($id)
            {   
                $entityManageree=$this->getDoctrine()->getManager();
                $stock = $entityManageree->getRepository(Stock::class)->find($id);
                return $this->render('stockc/show_front.html.twig', [
                    'id' => $stock->getId(),
                    'nom' => $stock->getNomst(),
                    'quantite' => $stock->getQuantites(),
                    'dateexpiration' => $stock->getDateexpirationst(),
                    'descripion' => $stock->getdescription(),
                    'categories' => $stock->getStockcat(),
                ]);
            }



    #[Route('/s', name: 'app_stockc_index', methods: ['GET'])]
    public function index(Request $request,StockcategoriesRepository $StockcategoriesRepository,StockRepository $stockRepository ,AjoutNotificationService $notificationService): Response
   {
    $entityManager = $this->getDoctrine()->getManager();
    $stocks = $entityManager->getRepository(Stock::class)
        ->findBy([], ['nomst' => 'ASC']);
    $stock = $entityManager->getRepository(Stock::class)->findAll();
    foreach ($stocks as $stock) {   
     if ($stock->getQuantites() < 10) {
            $notificationService->sendEmailIfnew($stock);
        }
    }
    return $this->render('stockc/index.html.twig', [
        'stocks' => $stocks,
        
        'categories' => $StockcategoriesRepository->findAll(),
    ]);
    
 }

 #[Route('/filtrer', name:'app_medicament_filtrer', methods: ['POST'])]
 public function filtrer(StockcategoriesRepository $StockcategoriesRepository,Request $request){
                    
     $selectedValue = $request->request->get('category');
                    
     $stocks=$this->getDoctrine()
     ->getRepository(Stock::class)
     ->createQueryBuilder('m')
     ->where('m.stockcat = :query')
     ->setParameter('query', $selectedValue)
     ->getQuery()
     ->getResult();
     return $this->render('stockc/index.html.twig', [
     'stocks' => $stocks,
     'categories' => $StockcategoriesRepository->findAll(),
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



    #[Route('/search', name: 'search')]

            public function searchAction(Request $request)
            {
                $em = $this->getDoctrine()->getManager();
                $requestString = $request->get('q');
                $stocks = $em->getRepository(Stock::class)->findEntitiesByString($requestString);
                if (!$stocks) {
                    $result['stocks']['error'] = "Medicament Not Found 🙁";
                } else {
                         $result['stocks'] = $this->getRealEntities($stocks);
                       }
                return new Response(json_encode($result));
            }
              
            public function getRealEntities($stocks)
            {
                foreach ($stocks as $stock) {
                    $realEntities[$stock->getId()] = [$stock->getStockcat(), $stock->getNomst()];
                }
            return $realEntities;
            }

            #[Route('/fe/{id}', name: 'app_stock_show' )]
            public function show($id)
            {   
                $entityManageree=$this->getDoctrine()->getManager();
                $stock = $entityManageree->getRepository(Stock::class)->find($id);
                return $this->render('stockc/show.html.twig', [
                    'id' => $stock->getId(),
                    'nom' => $stock->getNomst(),
                    'quantite' => $stock->getQuantites(),
                    'dateexpiration' => $stock->getDateexpirationst(),
                    'descripion' => $stock->getdescription(),
                    'categories' => $stock->getStockcat(),
                ]);
            }


            
        
        
            
                   
            
           
}
