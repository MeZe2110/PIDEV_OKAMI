<?php

namespace App\Controller;

use App\Entity\Historique;
use App\Entity\Rendezvous;
use App\Form\RendezvousType;
use App\Repository\UtilisateurRepository;
use App\Repository\HistoriqueRepository;
use App\Repository\RendezvousRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use DateTime;

class RendezvousControllerJSON extends AbstractController
{

    #[Route('/back/rendezvousJSON/', name: 'back_rendezvousJSON_index', methods: ['GET'])]
    public function backIndex(RendezvousRepository $rendezvousRepository, SerializerInterface $serializer): Response
    {
        $now = new \DateTime;
        $json = $serializer->serialize($rendezvousRepository->getRendezvous($now), 'json', ['groups' => 'rendezvous']);
        $json = $json . $serializer->serialize($rendezvousRepository->getOldRendezvous($now), 'json', ['groups' => 'rendezvous']);
        return new JsonResponse($json);
    }

    #[Route('/back/rendezvousJSON/new', name: 'rendezvousJSON_new', methods: ['GET', 'POST'])]
    public function backNew(Request $request, RendezvousRepository $rendezvousRepository, HistoriqueRepository $historiqueRepository, UtilisateurRepository $userRepository, SerializerInterface $serializer): Response
    {
        $userId = 2;

        $rendezvous = new Rendezvous();
        $rendezvous->setDaterv($request->get('daterv'));
        $rendezvous->setEndAt($request->get('endAt'));
        $rendezvous->setSalle($request->get('salle'));
        $rendezvous->setType($request->get('type'));
        $rendezvous->addUtilisateur($request->get('utilisateur'));
        $rendezvous->setRappel(true);

        $rendezvousRepository->save($rendezvous, true);
        $historique = new Historique();
        $historiqueRepository->save($historique->createHistorique("Rendez-vous " . $rendezvous->getId() . " créé", $userId, $userRepository), true);
        return new JsonResponse("Rendezvous added successfully" . $serializer->serialize($rendezvous, 'json', ['groups' => 'rendezvous']));
    }

    #[Route('back/rendezvousJSON/edit/{id}', name: 'rendezvousJSON_edit', methods: ['GET', 'POST'])]
    public function backEdit($id, Request $request, Rendezvous $rendezvous, RendezvousRepository $rendezvousRepository, HistoriqueRepository $historiqueRepository, UtilisateurRepository $userRepository, SerializerInterface $serializer): Response
    {
        $userId = 2;
        
        $rendezvous = $rendezvousRepository->find($id);
        $rendezvous->setDaterv($request->get('daterv'));
        $rendezvous->setEndAt($request->get('endAt'));
        $rendezvous->setSalle($request->get('salle'));
        $rendezvous->setType($request->get('type'));
        $rendezvous->addUtilisateur($request->get('utilisateur'));

        $rendezvousRepository->save($rendezvous, true);
        $historique = new Historique();
        $historiqueRepository->save($historique->createHistorique("Rendez-vous ". $rendezvous->getId() . " modifié", $userId, $userRepository), true);
        
        return new JsonResponse("Rendezvous updated successfully" . $serializer->serialize($rendezvous, 'json', ['groups' => 'rendezvous']));
    }

    #[Route('back/rendezvousJSON/delete/{id}', name: 'rendezvousJSON_delete', methods: ['POST'])]
    public function backDelete(Rendezvous $rendezvous, RendezvousRepository $rendezvousRepository, HistoriqueRepository $historiqueRepository, UtilisateurRepository $userRepository, SerializerInterface $serializer): Response
    {
        $userId = 2;

        $id = $rendezvous->getId();
        $rendezvousRepository->remove($rendezvous, true);
        $historique = new Historique();
        $historiqueRepository->save($historique->createHistorique("Rendez-vous ". $id . " supprimé", $userId, $userRepository), true);

        return new JsonResponse("Rendezvous removed successfully" . $serializer->serialize($rendezvous, 'json', ['groups' => 'rendezvous']));
    }





    #[Route('/rendezvousJSON', name: 'front_rendezvousJSON_index', methods: ['GET'])]
    public function frontIndex(RendezvousRepository $rendezvousRepository, SerializerInterface $serializer): Response
    {
        // $userId = $session->get('userId');
        $userId = 2;
        $now = new \DateTime;
        return new JsonResponse($serializer->serialize($rendezvousRepository->getRendezvousByUser($now, $userId), 'json', ['groups' => 'rendezvous']));
    }


}