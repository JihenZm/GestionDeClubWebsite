<?php

namespace App\Controller;

use App\Entity\MailContact;
use App\Entity\Licencie;
use App\Form\LicencieType;
use App\Repository\LicencieRepository;
use App\Form\MailContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class MailContactController extends AbstractController
{
    #[Route('/mail/contact', name: 'app_mail_contact')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $emailContacts = $entityManager->getRepository(MailContact::class)->findAll();
        return $this->render('mail_contact/index.html.twig', [
            'emailContacts' => $emailContacts,
        ]);
    }
 

    #[Route('/contact/addEmail', name: 'add_email_contact')]
    public function new(Request $request , EntityManagerInterface $entityManager,LicencieRepository $licencieRepository  ): Response
    {
        $emailContacts= new MailContact();
        $form = $this->createForm(MailContactType::class,  $emailContacts, [
            'licencies' => $licencieRepository->findAll(),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        
            $entityManager->persist($emailContacts);
            $entityManager->flush();

            return $this->redirectToRoute('app_mail_contact');
        }

        $licencies = $entityManager->getRepository(Licencie::class)->findAll();

        return $this->render('mail_contact/add.html.twig', [
            'licencies' => $licencies,
            'form' => $form->createView(),

        ]);
}



 
    #[Route('/deleteEmailEdu/{id}', name: 'deleteEmailContact')]
    public function deleteEmailEdu(int $id, EntityManagerInterface $entityManager): Response
    {   
        $emailContacts = $entityManager->getRepository(MailContact::class)->find($id);

        if (!$emailContacts) {
            throw $this->createNotFoundException('L email avec l\'id ' . $id . ' n\'existe pas');
        }

        $entityManager->remove($emailContacts);
        $entityManager->flush();

        return $this->redirectToRoute('app_mail_contact');
    }




}
