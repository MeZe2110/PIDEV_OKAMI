<?php

namespace App\Controller;

use App\Repository\EquipementRepository;
use App\Entity\Equipement;
use App\Entity\Categoriesequipement;
use App\Form\EquipementType;
use App\Form\CategoriesequipementType;
use App\Repository\CategoriesequipementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;



class MobileController extends AbstractController
{

    #[Route('/AllJSON', name: 'app_equipement_mobile')]
    public function getEquipement(EquipementRepository $repo, NormalizerInterface  $normalizer)
    {
        $equipement=$repo->findAll();

        $equipementNormalises = $normalizer->normalize($equipement,'json',['groups'=>"Equipement", 'include' => "CategoriesEquipement"]);

        $json= json_encode($equipementNormalises);

        return new Response($json);
    }


    #[Route("/equipement/{id}", name: "equipement")]
    public function EquipementId($id, NormalizerInterface $normalizer, EquipementRepository $repo)
    {
        $equipement = $repo->find($id);
        $equipementNormalises = $normalizer->normalize($equipement, 'json', ['groups' => "Equipement"]);
        return new Response(json_encode($equipementNormalises));
    }


    #[Route("addEquipementJSON/new", name: "addequipementJSON")]
    public function addequipementJSON(Request $req,   NormalizerInterface $Normalizer)
    {

        $em = $this->getDoctrine()->getManager();
        $equipement = new Equipement();
        $equipement ->setNomeq($req->get('Nom'));
        $equipement ->setEtateq($req->get('Etat'));
        $equipement ->setDispoeq($req->get('Disponibilite'));
        $equipement ->setCate($req->get('Categorie'));
        $em->persist($equipement );
        $em->flush();

        $jsonContent = $Normalizer->normalize($equipement , 'json', ['groups' => 'Equipement']);
        return new Response(json_encode($jsonContent));
    }

    #[Route("updateEquipementJSON/{id}", name: "updateEquipementJSON")]
    public function updateEquipementJSON(Request $req, $id, NormalizerInterface $Normalizer)
    {

        $em = $this->getDoctrine()->getManager();
        $equipement  = $em->getRepository(Equipement::class)->find($id);
        $equipement ->setNomeq($req->get('Nom'));
        $equipement ->setEtateq($req->get('Etat'));
        $equipement ->setDispoeq($req->get('Disponibilite'));
        $equipement ->setCate($req->getCate('cate'));
        $em->flush();

        $jsonContent = $Normalizer->normalize($equipement , 'json', ['groups' => 'Equipement']);
        return new Response("Equipement updated successfully " . json_encode($jsonContent));
    }

    #[Route("deleteEquipementJSON/{id}", name: "deleteEquipementJSON")]
    public function deleteEquipementJSON(Request $req, $id, NormalizerInterface $Normalizer)
    {

        $em = $this->getDoctrine()->getManager();
        $equipement  = $em->getRepository(Equipement::class)->find($id);
        $em->remove($equipement );
        $em->flush();
        $jsonContent = $Normalizer->normalize($equipement , 'json', ['groups' => 'Equipement']);
        return new Response("Equipement deleted successfully " . json_encode($jsonContent));
    }

}