<?php

namespace App\Controller;
use App\Entity\User;
use App\Form\UserType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

use Doctrine\ORM\EntityManagerInterface;


class RegistrationController extends AbstractController

{
    private $passwordEncoder;
    public function __construct(UserPasswordHasherInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }


    #[Route('/registration', name: 'app_registration')]
    public function index(Request $request,EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm( UserType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $user->setPassword($this->passwordEncoder->hashPassword($user, $user->getPassword()));

            $user->setRoles(['ROLE_USER']);

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_login');
        
        
        }
        return $this->render('registration/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

