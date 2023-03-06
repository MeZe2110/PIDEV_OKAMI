<?php

namespace App\Controller;

use App\Entity\Categoriesvehicules;
use App\Repository\CategoriesvehiculesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
 
class MobileController extends AbstractController
{
    #[Route('/mobile', name: 'app_mobile', methods: ['GET','POST'])]
    public function index(): Response
    {
        return $this->render('mobile/index.html.twig', [
            'controller_name' => 'MobileController',
        ]);
    }

    #[Route('/affichemobile', name: 'app_mobile_list', methods: ['GET','POST'])]

    public function listkhaledbaoueb( Request $request, NormalizerInterface $normalizer,SerializerInterface $serializer): Response
    {
        $typeappointment= $this->getDoctrine()->getRepository(Categoriesvehicules::class)->findAll();

        ////
        
        $studentsNormalises = $normalizer->normalize($typeappointment, 'json', ['groups' => "students"]);
    
        // //* Nous utilisons la fonction json_encode pour transformer un tableau associatif en format JSON
        $json = json_encode($studentsNormalises);

        //* Nous renvoyons une réponse Http qui prend en paramètre un tableau en format JSON
        return new Response($json);
    }

    #[Route('/addjsoncat', name: 'aaaaaaCreate_postjs', methods: ["GET","POST"])]

    public function ferActionjsonlivembc(Request $request,NormalizerInterface $normalizer)
    {   
    $stock = new Categoriesvehicules();
        $typecatv = $request->get("typecatv");
        
        
        $stock->setTypecatv($typecatv);
        
           

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($stock);
            $entityManager->flush();
            
            $this->addFlash('info', 'Created Successfully !');
        
        $studentsNormalises = $normalizer->normalize($stock, 'json', ['groups' => "students"]);

        // //* Nous utilisons la fonction json_encode pour transformer un tableau associatif en format JSON
        $json = json_encode($studentsNormalises);
        return new Response($json);
 }
        ///


        #[Route("/affichemobile/{id}", name: "studentshow")]
    public function StudentId($id, NormalizerInterface $normalizer, CategoriesvehiculesRepository $repo)
    {
        $student = $repo->find($id);
        $studentNormalises = $normalizer->normalize($student, 'json', ['groups' => "students"]);
        return new Response(json_encode($studentNormalises));
    }
      
   




    #[Route("updatemobile/{id}", name: "updatestockJSONlllllll")]
    public function updatestockJSON(Request $request, $id, NormalizerInterface $Normalizer)
    {

        $em = $this->getDoctrine()->getManager();
        $Categoriesvehicules = $em->getRepository(Categoriesvehicules::class)->find($id);
        $typecatv = $request->request->get("typecatv");
        $Categoriesvehicules->setTypecatv($typecatv);

        $em->flush();

        $jsonContent = $Normalizer->normalize($Categoriesvehicules, 'json', ['groups' => 'students']);
        return new Response("stock updated successfully " . json_encode($jsonContent));
    }

    #[Route('/delete_catjson/{id}', name: 'delete_stockjsolllllllllllln', methods: ["GET","POST"])]

    public function deletestockAction(Request $request,NormalizerInterface $normalizer): Response
    {
        $id = $request->get('id');
        $entityManager = $this->getDoctrine()->getManager();
        $Categoriesvehicules = $entityManager->getRepository(Categoriesvehicules::class)->find($id);
        $entityManager->remove($Categoriesvehicules);
        $entityManager->flush();
        $studentsNormalises = $normalizer->normalize($Categoriesvehicules, 'json', ['groups' => "students"]);
        $json = json_encode($studentsNormalises);
        return new Response($json);


}

    }