<?php

namespace App\Controller\Admin;

use App\Controller\CalculatorController;
use App\Form\BookFormType;
use App\Entity\Book;
use App\Entity\FM;
use App\Repository\BookRepository;
use App\Repository\FmRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{

    private EntityManagerInterface $entityManager;
    private BookRepository $bookRepository;


    public function __construct(EntityManagerInterface $entityManager, BookRepository $bookRepository)
    {
        $this->entityManager = $entityManager;
        $this->bookRepository = $bookRepository;
    }
    #[Route('/book', name: 'app_book')]
    public function index(): Response
    {
        $books = $this->bookRepository->findAll();
        return $this->render('dashboard/book/index.html.twig', [
            'books' => $books
        ]);
    }

    #[Route('book/new', name: 'app_newbook')]
    public function new(Request $request): Response
    {
        $book = new Book;

        $form = $this->createForm(BookFormType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $book = $form->getData();
            $fmPapira = $book->getFM();
            $fmKorice = $book->getFM();

            $cijenaPapira = $fmPapira->getPrice();
            $cijenaKorice = $fmKorice->getPrice();
            $brojStranica = $book->getNrpage();

            $bookPrice = $this->add($cijenaPapira, $cijenaKorice, $brojStranica);
            $book->setBookPrice($bookPrice);
            $this->entityManager->persist($book);

            $this->entityManager->flush();

            return $this->redirectToRoute('app_result');
        }
        return $this->render('dashboard/book/novi.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('book/result', name: 'app_result', methods: "GET")]
    public function calculator(): Response
    {
        $book = $this->bookRepository->findBy([], ['id' => 'DESC'], 1)[0];
        $result = $book->getBookPrice();

        return $this->render('dashboard/calculator.html.twig', array('result' => $result));
    }

    private function add(int $cijenaPapira, int $cijenaKorice, int $brojStranica): int
    {
        $total = ($cijenaPapira * $brojStranica) + ($cijenaKorice * 2);
        return $total;
    }
}
