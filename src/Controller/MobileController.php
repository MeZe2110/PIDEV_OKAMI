<?php

namespace App\Controller;

use App\Entity\Categoriesequipement;
use App\Entity\Equipement;
use App\Form\EquipementType;
use App\Form\CategoriesequipementTypeType;
use App\Repository\CategoriesequipementRepository;
use App\Repository\EquipementRepository;
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

#[Route('/mobile')]
class MobileController extends AbstractController

{
    #[Route('/list', name: 'list_equipementcatjson')]

    public function Actionjson(Request $request,NormalizerInterface $normalizer,SerializerInterface $serializer, CategoriesequipementRepository $categoriesequipementRepository): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $Categoriesequipement = $entityManager->getRepository(Categoriesequipement::class)->findAll();
        //* students en  tableau associatif simple.
        $studentsNormalises = $normalizer->Normalize($Categoriesequipement, 'json', ['groups' => 'CategoriesEquipement']);

        // //* Nous utilisons la fonction json_encode pour transformer un tableau associatif en format JSON
        $json = json_encode($studentsNormalises);

        //* Nous renvoyons une réponse Http qui prend en paramètre un tableau en format JSON
        return new Response($json);
    }
    #[Route('/fer', name: 'list_equipementjson')]

    public function faActionjson(Request $request,NormalizerInterface $normalizer,SerializerInterface $serializer, EquipementRepository $EquipementRepository): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $Equipement = $entityManager->getRepository(Equipement::class)->findAll();
        //* students en  tableau associatif simple.
        $studentsNormalises = $normalizer->Normalize($Equipement, 'json', ['groups' => 'Equipement']);

        // //* Nous utilisons la fonction json_encode pour transformer un tableau associatif en format JSON
        $json = json_encode($studentsNormalises);

        //* Nous renvoyons une réponse Http qui prend en paramètre un tableau en format JSON
        return new Response($json);
    }


    #[Route('/addjs', name: 'Create_equipementjs', methods: ["GET","POST"])]

    public function ferActionjs(Request $request,NormalizerInterface $normalizer)
    {
        $equipement = new equipement();
        $nomeq = $request->request->get('nomeq');
        $etateq = $request->request->get('etateq');
        $dispoeq = $request->request->get('dispoeq');
        $cate = $request->request->get("cate");


        $equipement->setNomeq($nomeq);
        $equipement->setEtateq($etateq);
        $equipement->setDispoeq($dispoeq);
        $equipement->setCate($cate);


        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($equipement);
        $entityManager->flush();

        $this->addFlash('info', 'Created Successfully !');

        $studentsNormalises = $normalizer->normalize($equipement, 'json', ['groups' => "Equipement"]);

        // //* Nous utilisons la fonction json_encode pour transformer un tableau associatif en format JSON
        $json = json_encode($studentsNormalises);
        return new Response($json);
    }


    #[Route("update/{id}", name: "updateequipementJSON")]
    public function updateequipementJSON(Request $req, $id, NormalizerInterface $Normalizer)
    {

        $em = $this->getDoctrine()->getManager();
        $equipement = $em->getRepository(Equipement::class)->find($id);
        $equipement->setNomeq($req->get('nomeq'));
        $equipement->setEtateq($req->get('etateq'));
        $equipement->setDispoeq($req->get('dispoeq'));
        $equipement->setCate($req->get('cate'));
        $em->flush();

        $jsonContent = $Normalizer->normalize($equipement, 'json', ['groups' => 'Equipement']);
        return new Response("equipement updated successfully " . json_encode($jsonContent));
    }


    #[Route('/delete_equipementjson/{id}', name: 'delete_equipementjson', methods: ["GET","POST"])]

    public function deleteequipementAction(Request $request,NormalizerInterface $normalizer): Response
    {
        $id = $request->get('id');
        $entityManager = $this->getDoctrine()->getManager();
        $equipement = $entityManager->getRepository(Equipement::class)->find($id);
        $entityManager->remove($equipement);
        $entityManager->flush();
        $studentsNormalises = $normalizer->normalize($equipement, 'json', ['groups' => "Equipement"]);
        $json = json_encode($studentsNormalises);
        return new Response($json);


    }

}