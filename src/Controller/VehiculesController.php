<?php

namespace App\Controller;
use App\Service\AjoutNotificationService;
use App\Entity\Vehicules;
use App\Form\VehiculesType;
use App\Repository\VehiculesRepository;
use App\Repository\CategoriesvehiculesRepository; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints as Assert;
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;


#[Route('/vehicules')]
class VehiculesController extends AbstractController
{
    #[Route('/', name: 'app_vehicules_index', methods: ['GET','POST'])]
    public function index(VehiculesRepository $repository,Request $request, PaginatorInterface $paginator)
    {
        $vehicules=$repository->findAll();
       
        $back = null;

            if($request->isMethod("POST")){
                if ( $request->request->get('optionsRadios')){
                    $SortKey = $request->request->get('optionsRadios');
                    switch ($SortKey){
                        case 'nomvh':
                            $vehicules = $repository->SortBynomvh();
                            break;

                           
                    }
                }
                else
                {
                    
                    $type = $request->request->get('optionsearch');
                    $value = $request->request->get('Search');
                    switch ($type){
                        case 'nomvh':
                            $vehicules = $repository->findBynomvh($value);
                            break;
    
                            case 'descvh':
                                $vehicules = $repository->findBydescvh($value);
                            break;
            
                      
    
                        
    
                    }
                }

                if ( $vehicules){
                    $back = "success";
                }else{
                    $back = "failure";
                }
            }$vehicules = $paginator->paginate(
                $vehicules, /* query NOT result */
                $request->query->getInt('page', 1)/*page number*/,
                4/*limit per page*/
            );
            
        return $this->render('Vehicules/index.html.twig',['vehicules'=>$vehicules,'back'=>$back]);
    }
   ////////////////////////////////////////////////////////////////////

   
   /////////////////////////////////////////////////////////////////////
    #[Route('/front', name: 'app_vehicules_front')]
    public function front(VehiculesRepository $repository,Request $request, PaginatorInterface $paginator)
    {
        $vehicules=$repository->findAll();
        $back = null;
            
            if($request->isMethod("POST")){
                if ($request->request->get('optionsRadios')) {
                    $SortKeys = explode(',', $request->request->get('optionsRadios')); // split the string into an array of values
                    $vehicules = array();
                
                    if (in_array('nomvh', $SortKeys)) {
                        $vehicules = array_merge($vehicules, $repository->SortBynomvh());
                    }
                    if (in_array('dispovh', $SortKeys)) {
                        $vehicules = array_merge($vehicules, $repository->SortBydispovh());
                    }
                    if (in_array('typevh', $SortKeys)) {
                        $vehicules = array_merge($vehicules, $repository->SortBytypevh());
                    }
                    if (in_array('descvh', $SortKeys)) {
                        $vehicules = array_merge($vehicules, $repository->SortBycat1());
                    }
                    if (in_array('descvh1', $SortKeys)) {
                        $vehicules = array_merge($vehicules, $repository->SortBycat2());
                    }
                    if (in_array('descvh2', $SortKeys)) {
                        $vehicules = array_merge($vehicules, $repository->SortBycat3());
                    }
                }
                else
                {
                    $type = $request->request->get('optionsearch');
                    $value = $request->request->get('Search');
                    switch ($type){
                        case 'nomvh':
                            $vehicules = $repository->findBynomvh($value);
                            break;
    
                            case 'descvh':
                                $vehicules = $repository->findBydescvh($value);
                            break;
            
    
                    }
                }

                if ( $vehicules){
                    $back = "success";
                }else{
                    $back = "failure";
                }
            }$vehicules = $paginator->paginate(
                $vehicules, /* query NOT result */
                $request->query->getInt('page', 1)/*page number*/,
                8/*limit per page*/
            );
           
        return $this->render('Vehicules/affichagevh.html.twig',['vehicules'=>$vehicules,'back'=>$back]);
    }

  
//fn il pagination  

    #[Route('/pag', name: 'app_vehicules_pagination' )]
    public function khaledsss(Request $request, VehiculesRepository $vehiculesRepository, PaginatorInterface $paginator): Response
    {
        $vehicules = $vehiculesRepository->findAll();

        $vehicules = $paginator->paginate(
            $vehicules, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            6/*limit per page*/
        );

        return $this->render('vehicules/pagination.html.twig', [
            'vehicules' => $vehicules,
        ]);
    }



    #[Route('/new', name: 'app_vehicules_new', methods: ['GET', 'POST'])]
    public function new(Request $request,  VehiculesRepository $vehiculesRepository,AjoutNotificationService $notifcationService): Response
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
        $notifcationService->sendEmailIfnew($vehicule);


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
        
       
        #[Route('search', name: 'search')]
        public function searchAction(Request $request)
        {
            $em = $this->getDoctrine()->getManager();
            $requestString = $request->get('q');
            $vehicules = $em->getRepository(Vehicules::class)->findEntitiesByString($requestString);
            $result = array();
            if (!$vehicules) {
                $result['error'] = "vehicule not found 🙁";
            } else {
                foreach ($vehicules as $vehicule) {
                    $result[] = array(
                        'id' => $vehicule->getId(),
                        'name' => $vehicule->getNomvh(),
                        'etat' => $vehicule->getEtatvh(),
                        'image' => $vehicule->getImagesvh(),
                    );
                }
            }
            return new JsonResponse($result);
        }

       
        #[Route('cal', name: 'app_cal', methods: ['GET'])]
        public function cal(VehiculesRepository $VehiculesRepository)
        {
            $vehicules = $VehiculesRepository->findAll();
    
            $rdvs = [];
    
            foreach ($vehicules as $vehicules) {
                $rdvs[] = [
                    'id' => $vehicules->getId(),
                    'start' => $vehicules->getDate()->format('Y-m-d H:i:s'),
                    'and' => $vehicules->getDate()->format('Y-m-d H:i:s'),
                    'image' => $vehicules->getImagesvh(),
                    'nom' => $vehicules->getNomvh(),
                    'title' => $vehicules->getNomvh(),
                ];
            }
    
         
    
            $data = json_encode($rdvs);
    
            return $this->render('vehicules/showCalendar.html.twig', compact('data'));
        }
    
    //     #[Route('/filtrerV', name:'app_vehicule_filtrer', methods: ['POST'])]
    // public function filtrer(VehiculesRepository $VehiculesRepository ,Request $request){
    //         $this->logger->info("test");
    //         $selectedValue = $request->request->get('category');
    //         $this->logger->info($selectedValue);
    //         $vehicule=$this->getDoctrine()
    //         ->getRepository(Categorievehicules::class)
    //         ->createQueryBuilder('m')
    //         ->where('m.typecatv  = :query')
    //         ->setParameter('query', $selectedValue)
    //         ->getQuery()
    //         ->getResult();
    //         return $this->render('vehicules/index.html.twig', [
    //             'categoriesvehicules' => $categoriesvehicules,
    //             'categoriesvehicules' => $VehiculesRepository->findAll(),
    //         ]);
    // }
}
 
 