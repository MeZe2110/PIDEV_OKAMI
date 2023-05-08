<?php

namespace App\Controller;
use App\Entity\User;
use App\Entity\Roleuser; 
use App\Form\UserType;
//use App\Form\PostcommentType;
use App\Repository\UserRepository;
//use Doctrine\ORM\Tools\Pagination\Paginator; page1.2.3
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class  JsonstestController extends AbstractController
{
    #[Route('/lol', name: 'list_postjson')]

    public function listpostActionjson(Request $request,NormalizerInterface $normalizer,SerializerInterface $serializer, UserRepository $UserRepository): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $User = $entityManager->getRepository(User::class)->findAll();

             //* students en  tableau associatif simple.
        $studentsNormalises = $normalizer->normalize($User, 'json', ['groups' => "User"]);

        // //* Nous utilisons la fonction json_encode pour transformer un tableau associatif en format JSON
        $json = json_encode($studentsNormalises);

        //* Nous renvoyons une réponse Http qui prend en paramètre un tableau en format JSON
        return new Response($json);

    }

    #[Route("/n", name: "addUserJSON")]
 
    public function addStudentJSON(Request $req,   NormalizerInterface $Normalizer)
    {
        

        $em = $this->getDoctrine()->getManager();
        $User = new User();
        $User->setNom($req->get('nom'));
        $User->setPrenom($req->get('prenom'));
        $User->setEmail($req->get('Email'));
        $User->setPassword($req->get('Password'));
        
        $em->persist($User);
        $em->flush();

        $jsonContent = $Normalizer->normalize($User, 'json', ['groups' => 'User']);
        return new Response(json_encode($jsonContent));
    }

    #[Route("delete/{id}", name: "deleteUserJSON")]
    public function deleteUserJSON(Request $req, $id, NormalizerInterface $Normalizer)
    {

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(user::class)->find($id);
        $em->remove($user);
        $em->flush();
        $jsonContent = $Normalizer->normalize($user, 'json', ['groups' => 'User']);
        return new Response("User deleted successfully " . json_encode($jsonContent));
    }

    #[Route("/getuser/{id}", name: "jsonUser")]
    public function UserId($id, NormalizerInterface $normalizer, UserRepository $repo)
    {
        $user = $repo->find($id);
        $userNormalises = $normalizer->normalize($user, 'json', ['groups' => "User"]);
        return new Response(json_encode($userNormalises));
    }

}

