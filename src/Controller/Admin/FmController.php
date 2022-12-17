<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\FM;
use App\Form\FmFormType;
use App\Repository\FmRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FmController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    private FmRepository $FmRepository;

    public function __construct(EntityManagerInterface $entityManager, FmRepository $FmRepository)
    {
        $this->entityManager = $entityManager;
        $this->FmRepository = $FmRepository;
    }


    #[IsGranted('ROLE_ADMIN')]
    #[Route('/fm', name: 'app_fm')]
    public function index(): Response
    {
        $fms = $this->FmRepository->findAll();

        return $this->render('/dashboard/fm/index.html.twig', [
            'fms' => $fms,
        ]);
    }
    #[IsGranted('ROLE_ADMIN')]
    #[Route('fm/new', name: 'app_newfm')]
    public function new(Request $request): Response
    {
        $fm = new Fm;
        $form = $this->createForm(FmFormType::class, $fm);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $fm = $form->getData();

            $this->entityManager->persist($fm);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_fm');
        }
        return $this->render('dashboard/fm/novi.html.twig', [
            'fm' => $fm,
            'form' => $form->createView()
        ]);
    }
}
