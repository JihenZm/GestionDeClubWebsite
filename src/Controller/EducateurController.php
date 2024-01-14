<?php

namespace App\Controller;

use App\Entity\Educateur;
use App\Form\EducateurType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class EducateurController extends AbstractController
{
    #[Route('/educateur', name: 'app_educateur')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $educateurs = $entityManager->getRepository(Educateur::class)->findAll();
        return $this->render('educateur/index.html.twig', [
            'educateurs' => $educateurs,
        ]);
    }



    #[Route('/addEducateur', name: 'addEducateur')]
    public function addEducateur(Request $request, EntityManagerInterface $entityManager ): Response
    {
       $educateur = new Educateur();
       $form = $this->createForm(EducateurType::class,$educateur);
       $form->handleRequest($request);
       if($form->isSubmitted() && $form->isValid()){
        $entityManager->persist($educateur);
        $entityManager->flush();
        return $this->redirectToRoute('app_educateur');
       }
       return $this->render('educateur/add.html.twig', [
        'form' => $form->createView(),
    ]);
    }

    #[Route('/editEducateur/{id}', name: 'editeducateur')]
    public function editEducateur(Request $request, int $id, EntityManagerInterface $entityManager): Response
    {
        $educateur = $entityManager->getRepository(Educateur::class)->find($id);
    
        if (!$educateur) {
            throw $this->createNotFoundException('L educateur avec l\'id ' . $id . ' n\'existe pas');
        }
    
        $form = $this->createForm(EducateurType::class, $educateur);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('app_educateur');
        }
    
        return $this->render('educateur/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    #[Route('/changer_statut_educateur/{id}', name: 'app_educateur_change_status')]
    public function changeStatus(int $id, EntityManagerInterface $entityManager): Response
    {
        $educateur = $entityManager->getRepository(Educateur::class)->find($id);

        if (!$educateur) {
            throw $this->createNotFoundException('Éducateur non trouvé avec l\'ID ' . $id);
        }

        // Mettre à jour le statut isAdmin à true
        $educateur->setIsAdmin(true);
         
        // Enregistrez les modifications en base de données
        $entityManager->flush();

        return $this->redirectToRoute('app_educateur');
    }
    #[Route('/deleteEducateur/{id}', name: 'deleteEducateur')]
    public function deleteEducateur(int $id, EntityManagerInterface $entityManager): Response
    {   
        $educateur = $entityManager->getRepository(Educateur::class)->find($id);

        if (!$educateur) {
            throw $this->createNotFoundException('L educateur avec l\'id ' . $id . ' n\'existe pas');
        }

        $entityManager->remove($educateur);
        $entityManager->flush();

        return $this->redirectToRoute('app_educateur');
    }

}
