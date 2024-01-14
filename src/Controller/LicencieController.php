<?php

namespace App\Controller;

use App\Entity\Licencie;
use App\Entity\Categorie;
use App\Entity\Educateur;
use App\Form\LicencieType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

use App\Service\PasswordGenerator;


class LicencieController extends AbstractController
{
    #[Route('/licencie', name: 'app_licencie')]
    public function indexAction( EntityManagerInterface $entityManager): Response
    {
        $licencies = $entityManager->getRepository(Licencie::class)->findAll();
        $categories = $entityManager->getRepository(Categorie::class)->findAll();
        return $this->render('licencie/index.html.twig', [
            'categories' => $categories,
            'licencies' =>  $licencies,
        ]);
    
    }



#[Route('/addLicencie', name: 'addLicencie')]
public function addLicencie(Request $request, EntityManagerInterface $entityManager): Response
{
    $licencie = new Licencie();

    $form = $this->createForm(LicencieType::class, $licencie);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // Retrieve the related Contact entity from the Licencie entity
        $contact = $licencie->getContact();

        // Set Nom and Prenom values on the Contact entity
        $contact->setNom($licencie->getNom());
        $contact->setPrenom($licencie->getPrenom());

        // Persist and flush both entities
  
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


    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    // #[Route('/changer_statut_educateur/{id}', name: 'changer_statut_educateur')]
    // public function changerStatutEducateur($id): Response
    // {
    //     // Récupérez le licencié par son ID depuis la base de données
    //     $licencie = $this->entityManager->getRepository(Licencie::class)->find($id);

    //     if (!$licencie) {
    //         // Gérez le cas où le licencié n'est pas trouvé
    //         throw $this->createNotFoundException('Licencie non trouvé pour l\'ID '.$id);
    //     }

    //     // Mettez à jour le statut d'éducateur
    //     $licencie->setIsEducateur(true);

    //     // Persistez les changements dans la base de données
    //     $this->entityManager->flush();

   
    //     return $this->redirectToRoute('app_licencie');
    // }

    // #[Route('/changer_statut_educateur/{id}', name: 'changer_statut_educateur')]
    // public function changerStatutEducateur(
    //     $id,
    //     EntityManagerInterface $entityManager,
    //     PasswordGenerator $passwordGenerator,
    //     UserPasswordHasherInterface $passwordHasher
    // ): Response {
    //     // Récupérez le licencié par son ID depuis la base de données
    //     $licencie = $entityManager->getRepository(Licencie::class)->find($id);
    
    //     if (!$licencie) {
    //         throw $this->createNotFoundException('Licencie non trouvé pour l\'ID ' . $id);
    //     }
    
    //     // Mettez à jour le statut d'éducateur
    //     $licencie->setIsEducateur(true);
    
    //     // Créez un nouvel éducateur et associez-le au licencié
    //     $educateur = new Educateur();
    //     $educateur->setEmail($licencie->getContact()->getEmail()); // Utilisez l'email du contact du licencié
    
    //     $plainPassword = $passwordGenerator->generatePassword();
    //     $encodedPassword = $passwordHasher->hashPassword($educateur, $plainPassword);
    //     $educateur->setPassword($encodedPassword);
    
    //     // Associez l'éducateur au licencié
    //     $licencie->setEducateur($educateur);
    
    //     // Persistez les changements dans la base de données
    //     $entityManager->persist($educateur);
    //     $entityManager->flush();
    
    //     // Redirigez ou renvoyez une réponse appropriée
    //     return $this->redirectToRoute('app_licencie');
    // }
  
#[Route('/changer_statut_educateur/{id}', name: 'changer_statut_educateur')]
public function changerStatutEducateur(
    $id,
    EntityManagerInterface $entityManager
): Response {
    // Récupérez le licencié par son ID depuis la base de données
    $licencie = $entityManager->getRepository(Licencie::class)->find($id);

    if (!$licencie) {
        throw $this->createNotFoundException('Licencie non trouvé pour l\'ID ' . $id);
    }

    // Mettez à jour le statut d'éducateur
    $licencie->setIsEducateur(true);

    // Vérifiez si l'éducateur existe déjà
    $educateur = $licencie->getEducateur();
    if (!$educateur) {
        // Si l'éducateur n'existe pas, créez un nouvel éducateur et associez-le au licencié
        $educateur = new Educateur();
        $educateur->setEmail($licencie->getContact()->getEmail());
        $educateur->setNom($licencie->getNom()); // Supposons que vous ayez des méthodes getNom et getPrenom dans Licencie
        $educateur->setPrenom($licencie->getPrenom());
        $educateur->setNumLicence($licencie->getNumLicence());

        // Définissez le mot de passe
        $encodedPassword = "jihenmdp";
        $educateur->setPassword($encodedPassword);

        // Associez l'éducateur au licencié
        $licencie->setEducateur($educateur);

        // Persistez les changements dans la base de données
        $entityManager->persist($educateur);
    }

    // Persistez les changements dans la base de données pour le licencié
    $entityManager->flush();

    // Redirigez ou renvoyez une réponse appropriée
    return $this->redirectToRoute('app_educateur');
}
    
}


