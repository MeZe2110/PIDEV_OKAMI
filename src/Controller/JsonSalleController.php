<?php

namespace App\Controller;

use App\Entity\Salle;
use App\Entity\Plannification;
use App\Form\SalleType;
use App\Form\PlannificationType;
use App\Repository\SalleRepository;
use App\Repository\PlannificationRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class JsonSalleController extends AbstractController
{
    #[Route('/AllSalle', name: 'list_sallejson')]
    public function listpostActionjson(Request $request, NormalizerInterface $normalizer, SerializerInterface $serializer, SalleRepository $salleRepository): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $salles = $entityManager->getRepository(Salle::class)->findAll();

        //* students en  tableau associatif simple.
        $sallesNormalises = $normalizer->normalize($salles, 'json', ['groups' => "salles"]);

        // //* Nous utilisons la fonction json_encode pour transformer un tableau associatif en format JSON
        $json = json_encode($sallesNormalises);

        //* Nous renvoyons une réponse Http qui prend en paramètre un tableau en format JSON
        return new Response($json);
    }

    #[Route("/getSalle/{id}", name: "jsonSalle")]
    public function SalleId($id, NormalizerInterface $normalizer, SalleRepository $repo)
    {
        $salle = $repo->find($id);
        $salleNormalises = $normalizer->normalize($salle, 'json', ['groups' => "salles"]);
        return new Response(json_encode($salleNormalises));
    }

    #[Route("/new", name: "addSalleJSON")]
    public function addSalleJSON(Request $req,   NormalizerInterface $Normalizer)
    {

        $em = $this->getDoctrine()->getManager();
        $salle = new Salle();
        $salle->setNumsa($req->get('numsa'));
        $salle->setEtagesa($req->get('etagesa'));
        $salle->setTypesa($req->get('typesa'));
        $em->persist($salle);
        $em->flush();

        $jsonContent = $Normalizer->normalize($salle, 'json', ['groups' => 'salles']);
        return new Response(json_encode($jsonContent));
    }

    #[Route("update/{id}", name: "updateSalleJSON")]
    public function updateSalleJSON(Request $req, $id, NormalizerInterface $Normalizer)
    {

        $em = $this->getDoctrine()->getManager();
        $salle = $em->getRepository(Salle::class)->find($id);
        $salle->setNumsa($req->get('numsa'));
        $salle->setEtagesa($req->get('etagesa'));
        $salle->setTypesa($req->get('typesa'));

        $em->flush();

        $jsonContent = $Normalizer->normalize($salle, 'json', ['groups' => 'salles']);
        return new Response("Salle updated successfully " . json_encode($jsonContent));
    }

    #[Route("delete/{id}", name: "deleteSalleJSON")]
    public function deleteSalleJSON(Request $req, $id, NormalizerInterface $Normalizer)
    {

        $em = $this->getDoctrine()->getManager();
        $salle = $em->getRepository(Salle::class)->find($id);
        $em->remove($salle);
        $em->flush();
        $jsonContent = $Normalizer->normalize($salle, 'json', ['groups' => 'salles']);
        return new Response("Salle deleted successfully " . json_encode($jsonContent));
    }

    #[Route('/addsallejs', name: 'Create_sallejs', methods: ["GET","POST"])]

    public function addActionjs(Request $request,NormalizerInterface $normalizer)
    {
        $salle = new Salle();
        $numsa = $request->request->get("numsa");
        $etagesa = $request->request->get("etagesa");
        $typesa = $request->request->get("typesa");

        $salle->setNumsa($numsa);
        $salle->setEtagesa($etagesa);
        $salle->setTypesa($typesa);
        //$imageFile = $request->files->get('photo');

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($salle);
        $entityManager->flush();

        $this->addFlash('info', 'Created Successfully !');

        $sallesNormalises = $normalizer->normalize($salle, 'json', ['groups' => 'salles']);

        // //* Nous utilisons la fonction json_encode pour transformer un tableau associatif en format JSON
        $json = json_encode($sallesNormalises);
        return new Response($json);
    }

    #[Route('/AllPlannification', name: 'list_plannificationjson')]
    public function listplannificationjson(Request $request, NormalizerInterface $normalizer, SerializerInterface $serializer, PlannificationRepository $plannificationRepository): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $plannification = $entityManager->getRepository(Plannification::class)->findAll();

        //* students en  tableau associatif simple.
        $plannificationsNormalises = $normalizer->normalize($plannification, 'json', ['groups' => "plannifications"]);

        // //* Nous utilisons la fonction json_encode pour transformer un tableau associatif en format JSON
        $json = json_encode($plannificationsNormalises);

        //* Nous renvoyons une réponse Http qui prend en paramètre un tableau en format JSON
        return new Response($json);
    }

    #[Route("/getPlannification/{id}", name: "jsonSalle")]
    public function SalleJsonId($id, NormalizerInterface $normalizer, SalleRepository $repo)
    {
        $salle = $repo->find($id);
        $salleNormalises = $normalizer->normalize($salle, 'json', ['groups' => "salles"]);
        return new Response(json_encode($salleNormalises));
    }

}