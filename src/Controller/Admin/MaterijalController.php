<?php

namespace App\Controller\Admin;

use App\Entity\Materijal;
use App\Form\MaterijalFormType;
use App\Repository\MaterijalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MaterijalController extends AbstractController
{
    /**
     * @var EntityManagerInterface $entitityManager
     * 
     */
    private $entityManager;
    /**
     * @var MaterijalRepository $materijalRepository
     */
    private $materijalRepository;
    public function __construct(EntityManagerInterface $entitityManager, MaterijalRepository $materijalRepository)
    {
        $this->entityManager = $entitityManager;
        $this->materijalRepository = $materijalRepository;
    }
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/materijal', name: 'app_materijal')]
    public function index(): Response
    {
        $materijals = $this->materijalRepository->findAll();

        return $this->render('dashboard/materijal/index.html.twig', [
            'materijals' => $materijals
        ]);
    }
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/materijal/new', name: 'app_newmaterial')]
    public function new(Request $request): Response
    {
        $material = new Materijal;

        $form = $this->createForm(MaterijalFormType::class, $material);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->entityManager->persist($material);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_materijal');
        }
        return $this->render('dashboard/materijal/novi.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
