<?php

namespace App\Controller;
use App\Entity\MailEdu;
use App\Entity\Educateur;
use App\Form\MailEduType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;


class MailEduController extends AbstractController
{
    #[Route('/mailEdu', name: 'app_mail_edu')]
    public function index(EntityManagerInterface $entityManager): Response
    {   $emailEdus = $entityManager->getRepository(MailEdu::class)->findAll(); 
        return $this->render('mail_edu/index.html.twig', [
            'emailEdus' => $emailEdus,
        ]);
    }


    #[Route('/addEmail', name: 'addEmailEdu')]
    public function addEmailEdu(Request $request, EntityManagerInterface $entityManager ): Response
    {
       $emailEdus = new MailEdu();
       $form = $this->createForm(MailEduType::class,$emailEdus);
       $form->handleRequest($request);
       $educateurs = $entityManager->getRepository(Educateur::class)->findAll();
       if($form->isSubmitted() && $form->isValid()){
        $entityManager->persist($emailEdus);
        $entityManager->flush();
        

        return $this->redirectToRoute('app_mail_edu');
       }
       return $this->render('mail_edu/add.html.twig', [
        'educateurs' => $educateurs,
        'form' => $form->createView(),
    ]);
    }

    
    #[Route('/deleteEmailEdu/{id}', name: 'deleteEmailEdu')]
    public function deleteEmailEdu(int $id, EntityManagerInterface $entityManager): Response
    {   
        $categorie = $entityManager->getRepository(MailEdu::class)->find($id);

        if (!$emailEdus) {
            throw $this->createNotFoundException('L email avec l\'id ' . $id . ' n\'existe pas');
        }

        $entityManager->remove($emailEdus);
        $entityManager->flush();

        return $this->redirectToRoute('app_mail_edu');
    }

    
}
