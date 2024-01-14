<?php

namespace App\Controller;
use App\Entity\MailEdu;
use App\Entity\Educateur;
use App\Form\MailEduType;
use App\Form\EducateurType;
use App\Repository\EducateurRepository;
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





 
#[Route('/addEmail', name: 'add_email_edu')]
public function new(Request $request , EntityManagerInterface $entityManager,EducateurRepository $educateurRepository ): Response
{
    $mailEdu = new MailEdu();
 

    $form = $this->createForm(MailEduType::class, $mailEdu, [
        'educateurs' => $educateurRepository->findAll(),
    ]);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
       
        $entityManager->persist($mailEdu);
        $entityManager->flush();

        return $this->redirectToRoute('app_mail_edu');
    }
    $educateurs = $entityManager->getRepository(Educateur::class)->findAll();
    return $this->render('mail_edu/add.html.twig', [
        
        'form' => $form->createView(),
        'educateurs' => $educateurs,
    ]);
}




// #[Route('/addEmail', name: 'add_email_edu')]
// public function addEmailEdu(Request $request, EntityManagerInterface $entityManager, MailService $mailService, MailerInterface $mailer): Response
// {
//     $emailEdus = new MailEdu();
//     $form = $this->createForm(MailEduType::class, $emailEdus);
//     $form->handleRequest($request);

//     // Move this line inside the condition if needed
//     $emailEdus->setDateEnvoi(new \DateTime());

//     if ($form->isSubmitted() && $form->isValid()) {
//         $entityManager->persist($emailEdus);
//         $entityManager->flush();

//         foreach ($this->Educateurs as $educateur) {
//             $email = (new Email())
//                 ->from('manelzemzem649@gmail.com')
//                 ->to($educateur->getEmail())
//                 ->subject($emailEdus->getObjet())
//                 ->html($emailEdus->getMessage());

//             $mailer->send($email);
//             $this->addFlash(
//                 'success',
//                 'Votre email a été envoyé avec succès !'
//             );
//         }

//         // Utilize the MailService to send the email to educators
//         $mailService->setEducateurs($emailEdus->getEducateurs()->toArray());
//         $mailService->setObjet($emailEdus->getObjet());
//         $mailService->setMessage($emailEdus->getMessage());

//         return $this->redirectToRoute('app_mail_edu');
//     }

//     $educateurs = $entityManager->getRepository(Educateur::class)->findAll();

//     return $this->render('mail_edu/add.html.twig', [
//         'form' => $form->createView(),
//         'educateurs' => $educateurs,
//     ]);
// }


        
#[Route('/deleteEmailEdu/{id}', name: 'deleteEmailEdu')]
public function deleteEmailEdu(int $id, EntityManagerInterface $entityManager): Response
{   
    $emailEdu = $entityManager->getRepository(MailEdu::class)->find($id);

    if (!$emailEdu) {
        $this->addFlash('error', 'L email avec l\'id ' . $id . ' n\'existe pas.');
        return $this->redirectToRoute('app_mail_edu');
    }

    $entityManager->remove($emailEdu);
    $entityManager->flush();

    $this->addFlash('success', 'L email a été supprimé avec succès.');
    return $this->redirectToRoute('app_mail_edu');
}

}
