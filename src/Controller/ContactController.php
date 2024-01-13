<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Categorie;
use App\Entity\Licencie;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
class ContactController extends AbstractController
{
    #[Route('/contacts', name: 'app_contact')] // Updated route to include category parameter
    public function index( EntityManagerInterface $entityManager): Response // Corrected parameter type
    {


        $contacts = $entityManager->getRepository(Contact::class)->findAll();
        $categories = $entityManager->getRepository(Categorie::class)->findAll();

        return $this->render('contact/index.html.twig', [
            'contacts' => $contacts,
            
        ]);
        // $licencies = $category->getLicencies();

        // return $this->render('contact/index.html.twig', [
        //     'contacts' => $this->getContactsFromLicencies($licencies),
        //     'category' => $category,
        // ]);
    }

    // private function getContactsFromLicencies($licencies)
    // {
    //     $contacts = [];

    //     foreach ($licencies as $licencie) {
    //         $contact = $licencie->getContact();

    //         // Ensure the Licencie has a Contact associated
    //         if ($contact !== null) {
    //             $contacts[] = $contact;
    //         }
    //     }

    //     return $contacts;
    // }

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/contacts/{id}', name: 'app_contacts_by_category')]
    public function contactsByCategory(int $id ): Response
    {
        $categorie = $this->entityManager->getRepository(Categorie::class)->find($id);

        $contacts = $categorie->getLicencies()->map(function ($licencie) {
            return $licencie->getContact();
        });

        return $this->render('contact/index.html.twig', [
            'categories' => $categorie,
            'contacts' => $contacts,
        ]);
    }
}

 