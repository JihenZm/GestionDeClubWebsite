<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LicencieController extends AbstractController
{
    #[Route('/licencie', name: 'app_licencie')]
    public function index(): Response
    {
        return $this->render('licencie/index.html.twig', [
            'controller_name' => 'LicencieController',
        ]);
    }
}
