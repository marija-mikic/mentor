<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalculatorController extends AbstractController
{
    #[Route('book/new', name: 'app_newbook', methods: "GET")]
    public function calculator(Request $request)
    {
        $calculator = new Book();
        $form = $this->createForm(BookFormType::class, $calculator);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $calculator = $form->getData();

            $result = $calculator->calculate();
            dd($result);
            return $this->render('dashboard/book/novi.html.twig', array(
                'form' => $form->createView(),
                'result' => $result
            ));
        }

        return $this->render('dashboard/book/novi.html.twig', array('form' => $form->createView()));
    }
}
