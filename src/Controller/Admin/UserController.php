<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Form\UserFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;

class UserController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     * 
     */
    private EntityManagerInterface $entityManager;
    /**
     * @var UserRepository
     * 
     */
    private  UserRepository $userRepository;

    public function __construct(EntityManagerInterface $entityManager, UserRepository $userRepository)
    {
        $this->entityManager = $entityManager;
        $this->userRepository = $userRepository;
    }


    #[IsGranted('ROLE_ADMIN')]
    #[Route('/user', name: 'app_user', methods: 'GET')]
    public function index(): Response
    {
        $users = $this->userRepository->findAll();

        return $this->render('dashboard/user/index.html.twig', [
            'users' => $users
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}/edit', name: 'user_edit')]
    public function edit(int $id, Request $request): Response
    {

        $user = $this->userRepository->find($id);
        $form = $this->createForm(UserFormType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $this->entityManager->flush();

            return $this->redirectToRoute('app_user');
        }
        return $this->render('dashboard/user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView()
        ]);
    }
}
