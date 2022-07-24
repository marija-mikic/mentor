<?php

namespace App\Controller;

 use http\Env\Request;
 use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 use Symfony\Component\HttpFoundation\Response;
 use Symfony\Component\Routing\Annotation\Route;

class MainController
{
    /**
     * @Route("/home", name="main")
     */
    #[Route]
    public function index(): Response
    {
        echo $this->render('main', [
            'content' => $this->view->render('index')
        ]);
    }
}