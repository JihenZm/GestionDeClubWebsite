<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MailEduController extends AbstractController
{
    #[Route('/mail/edu', name: 'app_mail_edu')]
    public function index(): Response
    {
        return $this->render('mail_edu/index.html.twig', [
            'controller_name' => 'MailEduController',
        ]);
    }
}
