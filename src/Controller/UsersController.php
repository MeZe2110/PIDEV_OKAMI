<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use App\Form\RechercheTypeMail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

#[Route('/users')]
class UsersController extends AbstractController
{


    /*#[Route('/', name: 'app_users')]
    public function index(): Response
    {
        return $this->render('users/index.html.twig', [
            'controller_name' => 'UsersController',
        ]);
    }*/
    #[Route('/alluser/CarteJson', name: 'alluser', methods:["GET"])]
    public function alluser(UserRepository $userRepository , SerializerInterface $serializer)
    {
        $user = $userRepository->findAll();
        $json = $serializer->serialize($user, 'json', ['groups' => "user"]);
        return new Response($json);
    }

    #[Route("/userbyid/{id}", name: "userbyid")]
    public function userbyid($id, NormalizerInterface $normalizer,UserRepository $userRepository)
    {
        $user = $userRepository->find($id);
        $userNormalises = $normalizer->normalize($user, 'json', ['groups' => "user"]);
        return new Response(json_encode($userNormalises));
    }

    
    #[Route('/upup',name:'app_upup',methods: ["GET","POST"])]
    public function up(Request $req, NormalizerInterface $Normalizer,UserRepository $userRepository)
    {

        $user = $userRepository->find($req->get('id'));
        $user->setEmail($req->get('email'));
        $user->setPassword($req->get('password'));
        
        
        $userRepository->save($user, true);
        $jsonContent = $Normalizer->normalize($user, 'json', ['groups' => 'user']);
        return new Response("Demande Carte updated successfully " . json_encode($jsonContent));
    }


    #[Route("/updateuser", name: "updateuser" , methods: ["POST"])]
    public function updateuser(UserRepository $userRepository, Request $req, NormalizerInterface $Normalizer)
    {

        $user = $userRepository->find($req->get('id'));
        $user->setEmail($req->get('email'));
        $user->setPassword($req->get('password'));
        
        
        $userRepository->flush();
        $jsonContent = $Normalizer->normalize($user, 'json', ['groups' => 'user']);
        return new Response("Demande Carte updated successfully " . json_encode($jsonContent));
    }



    #[Route("/adduser/JSON", name: "adduser" , methods: ["GET","POST"]) ]
    public function adduser(UserRepository $userRepository, Request $req, NormalizerInterface $Normalizer)
    {

        $user = new User();
      
        $user->setEmail($req->get('email'));
        $user->setPassword($req->get('password'));
       
        $userRepository->persist($user);
        $userRepository->flush();
        $jsonContent = $Normalizer->normalize($user, 'json', ['groups' => 'user']);
        return new Response(json_encode($jsonContent));


        // $serialize = new Serializer([new ObjectNormalizer()]);

        //     $formatted = $serialize->normalize("ReservationExcursiona ete supprimee avec success.");

        //     return new JsonResponse($formatted);

        // $jsonContent = $Normalizer->normalize($cartes, 'json', ['groups' => 'cartes']);
        // return new JsonResponse('added');
    }

    #[Route("/deleteuser/{id}", name: "deleteuser" , methods: ["POST"])]
    public function deleteuser(UserRepository $userRepository, Request $req, $id, NormalizerInterface $Normalizer)
    {

        $user = $userRepository->find($id);
        $userRepository->remove($user);
        $userRepository->flush();
        $jsonContent = $Normalizer->normalize($user, 'json', ['groups' => 'user']);
        return new Response("Demande Carte deleted successfully " . json_encode($jsonContent));
    }



    
}
