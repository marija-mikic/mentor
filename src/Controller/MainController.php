<?php

namespace App\Controller;

 use http\Env\Request;
 use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 use Symfony\Component\HttpFoundation\Response;
 use Symfony\Component\Routing\Annotation\Route;

final class MainController extends AbstractController
{
	/**
     * @Route("/home", name="main")
     */
    #[Route]
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => MainController::class
        ]);
    }
}
