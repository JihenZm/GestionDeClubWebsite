<?php

class EducateurController {
    private $educateurDAO;
    private $categorieDAO;
    private $contactDAO;


    public function __construct(EducateurDAO $educateurDAO, CategorieDAO $categorieDAO, contactDAO $contactDAO) {
        $this->educateurDAO = $educateurDAO;
        $this->categorieDAO = $categorieDAO;
        $this->contactDAO = $contactDAO;
    }
    
    public function index() {
        // Récupérer toutes les catégories
        $educateurs = $this->getAllEducateurs();
    
        // Inclure la vue pour afficher le tableau des catégories
        include('views/EducateurView.php');
    }  


    public function add()
{
    // Vérifier si le formulaire est soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer les données du formulaire
        $newNumeroLicence = $_POST['numero_licence'] ?? null;
        $newNom = $_POST['nom'] ?? null;
        $newPrenom = $_POST['prenom'] ?? null;
        $newCategorieId = $_POST['categorie_id'] ?? null;
        $newContactId = $_POST['contact_id'] ?? null;
        $newEmail = $_POST['email'] ?? null;
        $newMotDePasse = $_POST['mot_de_passe'] ?? null;
        $newIsAdmin = $_POST['is_admin'] ?? null;

        var_dump($newNumeroLicence, $newNom, $newPrenom, $newCategorieId, $newContactId, $newEmail, $newMotDePasse, $newIsAdmin);

        // Vérifier si toutes les données nécessaires sont présentes
        if ($newNumeroLicence && $newNom && $newPrenom && $newContactId && $newCategorieId && $newEmail && $newMotDePasse !== null && $newIsAdmin !== null) {
            // Récupérer l'objet Contact à partir de son ID
            $contact = $this->contactDAO->getById($newContactId);

            // Récupérer l'objet Categorie à partir de son ID
            $categorie = $this->categorieDAO->getById($newCategorieId);

            // Vérifier si les objets Contact et Categorie existent
            if ($contact && $categorie) {
                // Créer un nouveau éducateur
                $newEducateur = new Educateur($newNumeroLicence, $newNom, $newPrenom, $categorie, $contact, $newEmail, $newMotDePasse, $newIsAdmin);

                // Ajouter le nouveau éducateur dans la base de données
                $success = $this->educateurDAO->save($newEducateur);

                if ($success) {
                    // Redirection après l'ajout réussi
                    header('Location: index.php?page=educateur&action=index');
                    exit();
                } else {
                    echo "Erreur lors de l'ajout de l'éducateur";
                    exit();
                }
            } else {
                echo "Contact ou catégorie non trouvée";
                exit();
            }
        } else {
            echo "Données du formulaire manquantes";
            exit();
        }
    }

    // Afficher le formulaire d'ajout d'éducateur
    include 'views/EducateurAdd.php';
}

public function edit($id)
{
    // Récupérer l'éducateur à éditer depuis la base de données
    $educateurToEdit = $this->educateurDAO->getById($id);

    // Vérifier si l'éducateur existe
    if (!$educateurToEdit) {
        echo "Éducateur non trouvé";
        exit();
    }

    // Traitement du formulaire de modification (si le formulaire est soumis)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer les données du formulaire
        $newNumeroLicence = isset($_POST['numero_licence']) ? $_POST['numero_licence'] : null;
        $newNom = isset($_POST['nom']) ? $_POST['nom'] : null;
        $newPrenom = isset($_POST['prenom']) ? $_POST['prenom'] : null;
        $newContactId = isset($_POST['contact']) ? $_POST['contact'] : null;
        $newCategorieId = isset($_POST['categorie']) ? $_POST['categorie'] : null;

        // Vérifier si les données nécessaires sont présentes
        if ($newNumeroLicence !== null && $newNom !== null && $newPrenom !== null && $newContactId !== null && $newCategorieId !== null) {
            // Récupérer l'objet Contact à partir de son ID
            // Récupérer l'objet Categorie à partir de son ID
            $contact = $this->contactDAO->getById($newContactId);
            $categorie = $this->categorieDAO->getById($newCategorieId);

            // Vérifier si les objets Contact et Categorie existent
            if ($contact && $categorie) {
                // Mettre à jour l'éducateur dans la base de données
                $educateurToEdit->setNumeroLicence($newNumeroLicence);
                $educateurToEdit->setNom($newNom);
                $educateurToEdit->setPrenom($newPrenom);
                $educateurToEdit->setContact($contact);

                // Assurez-vous que $categorie est une instance de Categorie
                if ($categorie instanceof Categorie) {
                    $educateurToEdit->setCategorie($categorie);
                } else {
                    // Gérer le cas où $categorie n'est pas une instance de Categorie
                    echo "La catégorie n'est pas valide.";
                    exit();
                }

                $success = $this->educateurDAO->update($educateurToEdit);

                if ($success) {
                    // Redirection après l'édition réussie
                    header('Location: index.php?page=educateur&action=index');
                    exit();
                } else {
                    echo "Erreur lors de la mise à jour de la catégorie";
                    exit();
                }

            } else {
                echo "Contact ou catégorie non trouvée";
                exit();
            }
        } else {
            echo "Données du formulaire manquantes";
            exit();
        }
    }

    // Passer l'éducateur à la vue
    include 'views/EducateurEdit.php';
}

public function delete($id)
{
        // Récupérer le licencié à supprimer depuis la base de données
    $educateurToDelete = $this->educateurDAO->getById($id);

    // Vérifier si le licencié existe
    if (!$educateurToDelete) {
        echo "Educateur non trouvé";
    exit();
}

    // Supprimer le licencié de la base de données
    $success = $this->educateurDAO->delete($educateurToDelete);

    if ($success) {
        // Redirection après la suppression réussie
        header('Location: index.php?page=educateur&action=index');
        exit();
    } else {
        echo "Erreur lors de la suppression de l'éducateur";
        exit();
    }
}

    public function getAllEducateurs() {
        // Récupérer tous les éducateurs
        $educateurs = $this->educateurDAO->getAll();

        // Retourner les éducateurs (peut être utilisé pour affichage, etc.)
        return $educateurs;
    }

    public function getEducateurById($id) {
        // Récupérer un éducateur par son ID
        $educateur = $this->educateurDAO->getById($id);

        // Retourner l'éducateur (peut être utilisé pour affichage, etc.)
        return $educateur;
    }

    public function saveEducateur(Educateur $educateur) {
        // Enregistrer un nouveau éducateur
        $success = $this->educateurDAO->save($educateur);

        // Retourner le succès de l'opération
        return $success;
    }

    public function updateEducateur(Educateur $educateur) {
        // Mettre à jour un éducateur existant
        $success = $this->educateurDAO->update($educateur);

        // Retourner le succès de l'opération
        return $success;
    }

    public function deleteEducateur(Educateur $educateur) {
        // Supprimer un éducateur
        $success = $this->educateurDAO->delete($educateur);

        // Retourner le succès de l'opération
        return $success;
    }
}

?>