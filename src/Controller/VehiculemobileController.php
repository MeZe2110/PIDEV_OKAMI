<?php

namespace App\Controller;

use App\Entity\Vehicules;
use App\Form\VehiculesType;
use App\Entity\Categoriesvehicules;
use App\Repository\VehiculesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class VehiculemobileController extends AbstractController
{
    #[Route('/vehiculemobile', name: 'app_vehiculemobile')]
    public function index(): Response
    {
        return $this->render('vehiculemobile/index.html.twig', [
            'controller_name' => 'VehiculemobileController',
        ]);
    }
    #[Route('/vehiculeaffichemobile', name: 'app_mobile_listvehicule', methods: ['GET','POST'])]

    public function listkhaledbaouebvehicules( Request $request, NormalizerInterface $normalizer,SerializerInterface $serializer): Response
    {
        $typeappointment= $this->getDoctrine()->getRepository(Vehicules::class)->findAll();

        ////
        
        $studentsNormalises = $normalizer->normalize($typeappointment, 'json', ['groups' => "vehicules"]);
    
        // //* Nous utilisons la fonction json_encode pour transformer un tableau associatif en format JSON
        $json = json_encode($studentsNormalises);

        //* Nous renvoyons une réponse Http qui prend en paramètre un tableau en format JSON
        return new Response($json);
    }


    #[Route('/vehiculeaddjs', name: 'Create_postjs', methods: ["GET","POST"])]
    public function ferActionjs(Request $request, NormalizerInterface $normalizer)
{   
    $vehicule = new Vehicules();
    $entityManager = $this->getDoctrine()->getManager();
    $categoriesvehicule = $entityManager->getRepository(Categoriesvehicules::class)->findAll();
    
    $nomvh = $request->get("nomvh");
    $dispovh = $request->get("dispovh");
    $detatvh = $request->get("detatvh");
    $descvh = $request->get("descvh");
    $typecatv = $request->get("typecatv");

    $vehicule->setNomvh($nomvh);
    $vehicule->setDispovh($dispovh);
    $vehicule->setEtatvh($detatvh);
    $vehicule->setDescvh($descvh);
    
    if(isset($imagesvh)) {
        $imageData = $data['imagesvh'];
        $imageFile = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));
        $fileName = uniqid() . '.png';
        file_put_contents($this->getParameter('app.photos_directory').'/'.$fileName, $imageFile);
        $vehicule->setImagesvh($fileName);
    }

    $catv = $entityManager->getRepository(Categoriesvehicules::class)->findOneBy(['typecatv' => 'catv']);
    $vehicule->setCatv($catv);

    $entityManager->persist($vehicule);
    $entityManager->flush();

    $this->addFlash('info', 'Created Successfully !');

    $vehiculeNormalised = $normalizer->normalize($vehicule, 'json', ['groups' => "vehicules"]);
    $categoriesNormalised = $normalizer->normalize($categoriesvehicule, 'json', ['groups' => "students"]);

    // We use json_encode function to transform an associative array to JSON format
    $response = [
        'vehicule' => $vehiculeNormalised,
        'categories' => $categoriesNormalised
    ];
    $json = json_encode($response);
    return new Response($json);
}


 #[Route("/affichemobilevehicule/{id}", name: "studentshowvehicule")]
 public function StudentId($id, NormalizerInterface $normalizer, VehiculesRepository $repo)
 {
     $student = $repo->find($id);
     $studentNormalises = $normalizer->normalize($student, 'json', ['groups' => "vehicules"]);
     return new Response(json_encode($studentNormalises));
 }

 #[Route("updatemobilevehicule/{id}", name: "updatestockJSON")]
 public function updatestockJSON(Request $request, $id, NormalizerInterface $Normalizer)
 {
     $em = $this->getDoctrine()->getManager();
     $Vehicules = $em->getRepository(Vehicules::class)->find($id);
     
     $data = json_decode($request->getContent(), true);
 
     $Vehicules->setNomvh($data['nomvh'] ?? $Vehicules->getNomvh());
     $Vehicules->setDispovh($data['dispovh'] ?? $Vehicules->getDispovh());
     $Vehicules->setEtatvh($data['etatvh'] ?? $Vehicules->getEtatvh());
     $Vehicules->setDescvh($data['descvh'] ?? $Vehicules->getDescvh());
     
     if(isset($data['imagesvh'])) {
        $imageData = $data['imagesvh'];
        $imageFile = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));
        $fileName = uniqid() . '.png';
        file_put_contents($this->getParameter('app.photos_directory').'/'.$fileName, $imageFile);
        $Vehicules->setImagesvh($fileName);
    }
 
     $catv = $em->getRepository(Categoriesvehicules::class)->findOneBy(['typecatv' => $data['catv']]);
     $Vehicules->setCatv($catv);
 
     $em->flush();
 
     $jsonContent = $Normalizer->normalize($Vehicules, 'json', ['groups' => 'vehicules']);
     return new Response("stock updated successfully " . json_encode($jsonContent));
 }

    #[Route('/delete_catjsonvehicule/{id}', name: 'delete_stockjson', methods: ["GET","POST"])]

    public function deletestockAction(Request $request,NormalizerInterface $normalizer): Response
    {
        $id = $request->get('id');
        $entityManager = $this->getDoctrine()->getManager();
        $Vehicules = $entityManager->getRepository(Vehicules::class)->find($id);
        $entityManager->remove($Vehicules);
        $entityManager->flush();
        $studentsNormalises = $normalizer->normalize($Vehicules, 'json', ['groups' => "Stovehiculesck"]);
        $json = json_encode($studentsNormalises);
        return new Response($json);


}

}
