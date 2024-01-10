<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EducateurController extends AbstractController
{
    #[Route('/educateur', name: 'app_educateur')]
    public function index(): Response
    {
        return $this->render('educateur/index.html.twig', [
            'controller_name' => 'EducateurController',
        ]);
    }
}
