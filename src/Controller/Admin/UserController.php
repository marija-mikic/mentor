<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Id;
use PhpParser\Node\Stmt\If_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/user', name: 'app_user', methods:'GET')]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('dashboard/user/index.html.twig', [
            'users'=>$userRepository->findAll(),
        ]);
    }

    
     #[Route('/{id}/edit', name:'user_edit', methods:'GET')]
    public function edit(User $user)
    {
        if($_SERVER['REQUEST_METHOD']==='POST')
        
            if(isset($_GET['submit'])){
                $user= new User();
                $user->getId($_POST['id']);
                $user->setName($_POST['name']);
                $user->setSurname($_POST['surname']);
                $user->setEmail('email');  
                             
                return $this->redirectToRoute('app_user');            
            }                
          
            return $this->render('dashboard/user/edit.html.twig',[
                'user'=>$user,   
                           
            ]); 
           
        }        
    
}  
