<?php

namespace App\Controller;

use App\Entity\Stock;
use App\Entity\Stockcategories;
use App\Form\StockcategoriesType;
use App\Form\StockType;
use App\Repository\StockRepository;
use App\Repository\StockcategoriesRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\EntityManagerInterface;

class JsonstockController extends AbstractController
{
    #[Route('/afficher', name: 'list_stockjson')]

    public function faActionjson(Request $request,NormalizerInterface $normalizer,SerializerInterface $serializer, StockRepository $StockRepository): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $stock = $entityManager->getRepository(Stock::class)->findAll();
        $options = [
            'groups' => ['Stock'],
            'max_depth' => 1 // limiter la profondeur de sérialisation à 1
        ];
             //* students en  tableau associatif simple.
        $studentsNormalises = $normalizer->Normalize($stock, null, $options);

        // //* Nous utilisons la fonction json_encode pour transformer un tableau associatif en format JSON
        $json = $serializer->serialize( $studentsNormalises, 'json');

        //* Nous renvoyons une réponse Http qui prend en paramètre un tableau en format JSON
        return new Response($json, 200, ['Content-Type' => 'application/json']);
    }


    #[Route('/addjs', name: 'Create_stockjs', methods: ["GET","POST"])]

    public function addActionjs(Request $request,NormalizerInterface $normalizer,SerializerInterface $serializer, EntityManagerInterface $entityManager)
    {  
      
     $stock = new stock();
        $nomst = $request->request->get("nomst");
        $description = $request->request->get("description");
        $dateexpirationst = $request->request->get("dateexpirationst");
        $quantites = $request->request->get("quantites");
        $typecat = $request->request->get("stockcat");


        $stock->setNomst($nomst);
        $stock->setQuantites($quantites);
        $stock->setDescription($description);
        $dateexpirationstObject = \DateTime::createFromFormat('Y-m-d', $dateexpirationst);
        $stock->setDateexpirationst($dateexpirationstObject);

        $stockcat = $entityManager->getRepository(Stockcategories::class)->findOneBy(['typecat' => $typecat]);
        $stock->setStockcat($stockcat);


  
        

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($stock);
        $entityManager->flush();
            
        
        
        $options = [
            'groups' => ['Stock'],
            'max_depth' => 1 // limiter la profondeur de sérialisation à 1
        ];
             //* students en  tableau associatif simple.
        $studentsNormalises = $normalizer->Normalize($stock, null, $options);

        // //* Nous utilisons la fonction json_encode pour transformer un tableau associatif en format JSON
        $json = $serializer->serialize( $studentsNormalises, 'json');

        //* Nous renvoyons une réponse Http qui prend en paramètre un tableau en format JSON
        return new Response($json, 200, ['Content-Type' => 'application/json']);
    }
    


 #[Route("update/{id}", name: "updatestockJSON")]
    public function updatestockJSON(Request $req, Request $request, $id, NormalizerInterface $Normalizer,EntityManagerInterface $entityManager)
    {

        $em = $this->getDoctrine()->getManager();
        $stock = $em->getRepository(Stock::class)->find($id);
        $stock->setNomst($req->get('nomst'));
        $stock->setDescription($req->get('description'));
        $stock->setQuantites($req->get('quantites'));

        $dateexpirationst = $request->request->get("dateexpirationst");
        $dateexpirationstObject = \DateTime::createFromFormat('Y-m-d', $dateexpirationst);
        $stock->setDateexpirationst($dateexpirationstObject);

        $typecat = $request->request->get("stockcat");
        $stockcat = $entityManager->getRepository(Stockcategories::class)->findOneBy(['typecat' => $typecat]);
        $stock->setStockcat($stockcat);

        $em->flush();

        $jsonContent = $Normalizer->normalize($stock, 'json', ['groups' => 'Stock']);
        return new Response("stock updated successfully " . json_encode($jsonContent));
    }


    #[Route('/delete_stockjson/{id}', name: 'delete_stockjson', methods: ["GET","POST"])]

    public function deletestockAction(Request $request,NormalizerInterface $normalizer): Response
    {
        $id = $request->get('id');
        $entityManager = $this->getDoctrine()->getManager();
        $stock = $entityManager->getRepository(Stock::class)->find($id);
        $entityManager->remove($stock);
        $entityManager->flush();
        $studentsNormalises = $normalizer->normalize($stock, 'json', ['Groups' => "Stock"]);
        $json = json_encode($studentsNormalises);
        return new Response($json);


   }

    }
