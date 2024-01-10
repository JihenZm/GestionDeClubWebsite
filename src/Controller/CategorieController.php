<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;


class CategorieController extends AbstractController
{

   


    #[Route('/categorie', name: 'app_categorie')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $categories = $entityManager->getRepository(Categorie::class)->findAll();

        return $this->render('categorie/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/addCategorie', name: 'addCategorie')]
    public function addCategorie(Request $request, EntityManagerInterface $entityManager ): Response
    {
       $categorie = new Categorie();
       $form = $this->createForm(CategorieType::class,$categorie);
       $form->handleRequest($request);
       if($form->isSubmitted() && $form->isValid()){
        $entityManager->persist($categorie);
        $entityManager->flush();
        return $this->redirectToRoute('app_categorie');
       }
       return $this->render('categorie/add.html.twig', [
        'form' => $form->createView(),
    ]);
    }

    #[Route('/editCategorie/{id}', name: 'editCategorie')]
    public function editCategorie(Request $request, int $id, EntityManagerInterface $entityManager): Response
    {
        $categorie = $entityManager->getRepository(Categorie::class)->find($id);
    
        if (!$categorie) {
            throw $this->createNotFoundException('La catégorie avec l\'id ' . $id . ' n\'existe pas');
        }
    
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('app_categorie');
        }
    
        return $this->render('categorie/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    
    #[Route('/deleteCategorie/{id}', name: 'deleteCategorie')]
    public function deleteCategorie(int $id, EntityManagerInterface $entityManager): Response
    {   
        $categorie = $entityManager->getRepository(Categorie::class)->find($id);

        if (!$categorie) {
            throw $this->createNotFoundException('La catégorie avec l\'id ' . $id . ' n\'existe pas');
        }

        $entityManager->remove($categorie);
        $entityManager->flush();

        return $this->redirectToRoute('app_categorie');
    }

    }
