<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Format;
use App\Form\FormatFormType;
use App\Repository\FormatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class FormatController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     * 
     */
    private EntityManagerInterface $entityManager;
    /**
     * @var FormatRepository
     * 
     */
    private  FormatRepository $formatRepository;

    public function __construct(EntityManagerInterface $entityManager, FormatRepository $formatRepository)
    {
        $this->entityManager = $entityManager;
        $this->formatRepository = $formatRepository;
    }
    #[Route('/format', name: 'app_format', methods: 'GET')]
    public function index(): Response
    {
        $formats = $this->formatRepository->findAll();

        return $this->render('dashboard/format/index.html.twig', [
            'formats' => $formats
        ]);
    }
    #[Route('format/new', name: 'app_newformat')]
    public function new(Request $request): Response
    {
        $format = new Format();
        $form = $this->createForm(FormatFormType::class, $format);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $format = $form->getData();
            $this->entityManager->persist($format);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_format');
        }
        return $this->render('dashboard/format/novi.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
