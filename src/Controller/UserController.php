<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user_index')]
    public function index(UserRepository $userRepository, Request $request): Response
    {
        $vehicules = $userRepository->findAll();

        $back = null;

        if ($request->isMethod("POST")) {
            if ($request->request->get('optionsRadios')) {
                $SortKey = $request->request->get('optionsRadios');
                switch ($SortKey) {
                    case 'nom':
                        $vehicules = $userRepository->SortBynom();
                        break;
                    case 'id':
                        $vehicules = $userRepository->SortByid();
                        break;
                }
            } else {
                $type = $request->request->get('optionsearch');
                $value = $request->request->get('Search');
                switch ($type) {
                    case 'nom':
                        $vehicules = $userRepository->findBynom($value);
                        break;
                }
            }

            if ($vehicules) {
                $back = "success";
            } else {
                $back = "failure";
            }
        }
        return $this->render('user/index.html.twig', [
            'users' => $vehicules, 'back' => $back
        ]);
    }

    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserRepository $userRepository): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        dump($user);
        if ($form->isSubmitted() && $form->isValid()) {
            dump($user);
            $userRepository->save($user, true);
            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/ordnom', name: 'order_By_email', methods: ['GET'])]
    public function Torder_By_NomJSON(UserRepository $UserRepository)
    {

        return $this->render('user/index.html.twig', [
            'users' => $UserRepository->order_By_Email(),
        ]);
    }

    #[Route('/ordno', name: 'order_By_nom', methods: ['GET'])]
    public function Torder_By_NoJSON(UserRepository $UserRepository)
    {

        return $this->render('user/index.html.twig', [
            'users' => $UserRepository->order_By_Nom(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, UserRepository $userRepository): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/show', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/remove', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }

    // function RechercheC(UserRepository $repository, Request $request)
    // {
    //     $data = $request->get('search ');
    //     $user = $repository->findBy(['id_ut' => $data]);
    //     return $this->render('user/rechercheOrderBy.html.twig', ['user' => $user]);
    // }

}
