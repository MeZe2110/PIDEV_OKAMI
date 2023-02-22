<?php

namespace App\Controller;

use App\Entity\Vehicules;
use App\Form\VehiculesType;
use App\Repository\VehiculesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints as Assert;
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\Persistence\ManagerRegistry;

#[Route('/vehicules')]
class VehiculesController extends AbstractController
{
    #[Route('/', name: 'app_vehicules_index')]
    public function index(VehiculesRepository $repository)
    {
        $vehicules=$repository->findAll();
        return $this->render('Vehicules/index.html.twig',['vehicules'=>$vehicules]);
    }
   
    #[Route('/front', name: 'app_vehicules_front')]
    public function front(VehiculesRepository $repository)
    {
        $vehicules=$repository->findAll();
        return $this->render('Vehicules/affichagevh.html.twig',['vehicules'=>$vehicules]);
    }


//fn il pagination  

    #[Route('/pag', name: 'app_vehicules_pagination' )]
    public function khaledsss(Request $request, VehiculesRepository $vehiculesRepository, PaginatorInterface $paginator): Response
    {
        $vehicules = $vehiculesRepository->findAll();

        $vehicules = $paginator->paginate(
            $vehicules, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/
        );

        return $this->render('vehicules/pagination.html.twig', [
            'vehicules' => $vehicules,
        ]);
    }



    #[Route('/new', name: 'app_vehicules_new', methods: ['GET', 'POST'])]
    public function new(Request $request,  VehiculesRepository $vehiculesRepository): Response
    {
        $vehicule = new Vehicules();
        $form = $this->createForm(VehiculesType::class, $vehicule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $imageFile = $form->get('imagesvh')->getData();
            if ($imageFile) {
                $newFilename = uniqid().'.'.$imageFile->getClientOriginalExtension();
                $imageFile->move(
                    $this->getParameter('app.photos_directory'),
                    $newFilename
                );
                $vehicule->setImagesvh($newFilename);
            }



            $vehiculesRepository->save($vehicule, true);

            return $this->redirectToRoute('app_vehicules_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('vehicules/new.html.twig', [
            'vehicule' => $vehicule,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_vehicules_show' )]
    public function show(Vehicules $vehicule)
    {
        return $this->render('vehicules/show.html.twig', [
            'vehicule' => $vehicule,
        ]);
    }

    #[Route('/front/{id}', name: 'hrouz' )]
    public function hrouz(Vehicules $vehicule)
    {
        return $this->render('vehicules/description.html.twig', [
            'vehicule' => $vehicule
        ]);
    }

    



    #[Route('/update_post/{id}', name: 'update_post')]

    public function updatepostAction(Request $request, $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $vehicules = $entityManager->getRepository(vehicules::class)->find($id);
        $form = $this->createForm(vehiculesType::class, $vehicules);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {



            $imageFile = $form->get('imagesvh')->getData();
            if ($imageFile) {
                $newFilename = uniqid().'.'.$imageFile->getClientOriginalExtension();
                $imageFile->move(
                    $this->getParameter('app.photos_directory'),
                    $newFilename
                );
                $vehicules->setImagesvh($newFilename);
            }

            
            
            $entityManager->persist($vehicules);
            $entityManager->flush();
            return $this->redirectToRoute('app_vehicules_index');
        }
        return $this->render('vehicules/edit.html.twig', [
            "form" => $form->createView(),
        ]);
    }
     



        #[Route('/suppc/{id}', name: 'supprimerc')]
        public function suppc(Request $request): Response
        {     $id = $request->get('id');
            $entityManager = $this->getDoctrine()->getManager();
            $vehicule = $entityManager->getRepository(vehicules::class)->find($id);
            $entityManager->remove($vehicule);
            $entityManager->flush();
            return $this->redirectToRoute('app_vehicules_index');
              
        }
    

    
}
 
 