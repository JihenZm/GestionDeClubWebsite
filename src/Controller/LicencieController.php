<?php

namespace App\Controller;

use App\Entity\Licencie;
use App\Form\LicencieType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class LicencieController extends AbstractController
{
    #[Route('/licencie', name: 'app_licencie')]
    public function indexAction( EntityManagerInterface $entityManager): Response
    {
        $licencies = $entityManager->getRepository(Licencie::class)->findAll();
        return $this->render('licencie/index.html.twig', [
            'licencies' =>  $licencies,
        ]);
    
    }

    #[Route('/addLicencie', name: 'addLicencie')]
    public function addLicencie (Request $request, EntityManagerInterface $entityManager ): Response
    {
       $licencie = new Licencie();
       $form = $this->createForm(LicencieType::class,$licencie);
       $form->handleRequest($request);
       if($form->isSubmitted() && $form->isValid()){
        $entityManager->persist($licencie);
        $entityManager->flush();
        return $this->redirectToRoute('app_licencie');
       }
       return $this->render('licencie/add.html.twig', [
        'form' => $form->createView(),
    ]);
    }



    #[Route('/editLicencie/{id}', name: 'editLicencie')]
    public function editLicencie(Request $request, int $id, EntityManagerInterface $entityManager): Response
    {
        $licencie = $entityManager->getRepository(Licencie::class)->find($id);
    
        if (!$licencie) {
            throw $this->createNotFoundException('Le licencie avec l\'id ' . $id . ' n\'existe pas');
        }
    
        $form = $this->createForm(LicencieType::class , $licencie);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('app_licencie');
        }
    
        return $this->render('licencie/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    
    #[Route('/deleteLicencie/{id}', name: 'deleteLicencie')]
    public function deleteLicencie(int $id, EntityManagerInterface $entityManager): Response
    {   
        $licencie = $entityManager->getRepository(Licencie::class)->find($id);

        if (!$licencie) {
            throw $this->createNotFoundException('Le licencie avec l\'id ' . $id . ' n\'existe pas');
        }

        $entityManager->remove($licencie);
        $entityManager->flush();

        return $this->redirectToRoute('app_licencie');
    }
}
