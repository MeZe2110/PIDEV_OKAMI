<?php

namespace App\Controller;

use App\Entity\Categoriesvehicules;
use App\Form\CategoriesvehiculesType;
use App\Repository\CategoriesvehiculesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Annotation\Groups;


#[Route('/categoriesvehicules')]
class CategoriesvehiculesController extends AbstractController
{
    #[Route('/', name: 'app_categoriesvehicules_index', methods: ['GET'])]
        public function index(CategoriesvehiculesRepository $categoriesvehiculesRepository): Response
        {
            return $this->render('categoriesvehicules/index.html.twig', [
                'categoriesvehicules' => $categoriesvehiculesRepository->findAll(),
            ]);
        }
        #[Route('/khaled', name: 'khaled', methods: ['GET'])]
        public function khaled(CategoriesvehiculesRepository $categoriesvehiculesRepository): Response
        {
            return $this->render('categoriesvehicules/index.html.twig', [
                'categoriesvehicules' => $categoriesvehiculesRepository->findAll(),
            ]);
        }


        #[Route('/bibibo', name: 'tafeoul')]
        public function jaweknice(Request $request,SerializerInterface $serializer ): Response
        {
    
            $categorie= $this->getDoctrine()->getRepository(Categoriesvehicules::class)->findAll();

           
                //* students en  tableau associatif simple.
                $studentsNormalises = $normalizer->normalize($categorie, 'json', ['groups' => "students"]);
    
                // //* Nous utilisons la fonction json_encode pour transformer un tableau associatif en format JSON
                $json = json_encode($studentsNormalises);
        
                //* Nous renvoyons une réponse Http qui prend en paramètre un tableau en format JSON
                return new Response($json);
            }
        


    #[Route('/new', name: 'app_categoriesvehicules_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CategoriesvehiculesRepository $categoriesvehiculesRepository): Response
    {
        $categoriesvehicule = new Categoriesvehicules();
        $form = $this->createForm(CategoriesvehiculesType::class, $categoriesvehicule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categoriesvehiculesRepository->save($categoriesvehicule, true);

            return $this->redirectToRoute('app_categoriesvehicules_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categoriesvehicules/new.html.twig', [
            'categoriesvehicule' => $categoriesvehicule,
            'form' => $form,
        ]);
    }
    #[Route('/neww', name: 'app_categoriesvehicules_neww', methods: ['GET', 'POST'])]
    public function neww(Request $request, CategoriesvehiculesRepository $categoriesvehiculesRepository): Response
    {
        $categoriesvehicule = new Categoriesvehicules();
        $form = $this->createForm(CategoriesvehiculesType::class, $categoriesvehicule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categoriesvehiculesRepository->save($categoriesvehicule, true);

            return $this->redirectToRoute('app_categoriesvehicules_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categoriesvehicules/new.html.twig', [
            'categoriesvehicule' => $categoriesvehicule,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_categoriesvehicules_show', methods: ['GET'])]
    public function show(Categoriesvehicules $categoriesvehicule): Response
    {
        return $this->render('categoriesvehicules/show.html.twig', [
            'categoriesvehicule' => $categoriesvehicule,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_categoriesvehicules_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Categoriesvehicules $categoriesvehicule, CategoriesvehiculesRepository $categoriesvehiculesRepository): Response
    {
        $form = $this->createForm(CategoriesvehiculesType::class, $categoriesvehicule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categoriesvehiculesRepository->save($categoriesvehicule, true);

            return $this->redirectToRoute('app_categoriesvehicules_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categoriesvehicules/edit.html.twig', [
            'categoriesvehicule' => $categoriesvehicule,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_categoriesvehicules_delete', methods: ['POST'])]
    public function delete(Request $request, Categoriesvehicules $categoriesvehicule, CategoriesvehiculesRepository $categoriesvehiculesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categoriesvehicule->getId(), $request->request->get('_token'))) {
            $categoriesvehiculesRepository->remove($categoriesvehicule, true);
        }

        return $this->redirectToRoute('app_categoriesvehicules_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/affichemobile', name: 'app_mobile_list')]

    public function list(TypeappoinmentRepository $repository  , Request $request, NormalizerInterface $normalizer,SerializerInterface $serializer)
    {
        $typeappointment= $this->getDoctrine()->getRepository(Categoriesvehicules::class)->findAll();

        ////
        
        $studentsNormalises = $normalizer->normalize($typeappointment, 'json', ['groups' => "students"]);
    
        // //* Nous utilisons la fonction json_encode pour transformer un tableau associatif en format JSON
        $json = json_encode($studentsNormalises);

        //* Nous renvoyons une réponse Http qui prend en paramètre un tableau en format JSON
        return new Response($json);
    }
}
