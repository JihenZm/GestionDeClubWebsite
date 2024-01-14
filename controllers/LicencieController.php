<?php
class LicencieController {
    private $licencieDAO;
    private $contactDAO;
    private $connexion;

    private $categorieDAO;

    public function __construct(LicencieDAO $licencieDAO, ContactDAO $contactDAO, CategorieDAO $categorieDAO) {
        $this->contactDAO = $contactDAO;
        $this->categorieDAO = $categorieDAO;
        $this->licencieDAO = $licencieDAO;
        $this->connexion = new Connexion(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
    }
        public function index() {
            // Récupérer toutes les catégories
            $licencies = $this->getAllWithContacts();
    
            // Inclure la vue pour afficher le tableau des catégories
            include('views/LicencieView.php');
        }
    
        public function add()
        {
            // Vérifier si le formulaire est soumis
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Récupérer les données du formulaire
                $newNumeroLicence = $_POST['numero_licence'] ?? null;
                $newNom = $_POST['nom'] ?? null;
                $newPrenom = $_POST['prenom'] ?? null;
                $newContactId = $_POST['contact'] ?? null;
                $newCategorieId = $_POST['categorie'] ?? null;
        
                // Vérifier si toutes les données nécessaires sont présentes
                if ($newNumeroLicence && $newNom && $newPrenom && $newContactId && $newCategorieId) {
                    // Récupérer l'objet Contact à partir de son ID
                    $contact = $this->contactDAO->getById($newContactId);
        
                    // Récupérer l'objet Categorie à partir de son ID
                    $categorie = $this->categorieDAO->getById($newCategorieId);
        
                    // Vérifier si les objets Contact et Categorie existent
                    if ($contact && $categorie) {
                        // Créer un nouveau licencié
                        $newLicencie = new Licencie();
                        $newLicencie->setNumeroLicence($newNumeroLicence);
                        $newLicencie->setNom($newNom);
                        $newLicencie->setPrenom($newPrenom);
                        $newLicencie->setContact($contact);
                        $newLicencie->setCategorie($categorie);
        
                        // Ajouter le nouveau licencié dans la base de données
                        $success = $this->licencieDAO->save($newLicencie);
        
                        if ($success) {
                            // Redirection après l'ajout réussi
                            header('Location: index.php?page=licencie&action=index');
                            exit();
                        } else {
                            echo "Erreur lors de l'ajout du licencié";
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
        
            // Afficher le formulaire d'ajout de licencié
            include 'views/LicencieAdd.php';
        }
        
        public function edit($id)
        {
            // Récupérer le licencié à éditer depuis la base de données
            $licencieToEdit = $this->licencieDAO->getById($id);
        
            // Vérifier si le licencié existe
            if (!$licencieToEdit) {
                echo "Licencié non trouvé";
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
                        // Mettre à jour le licencié dans la base de données
                        $licencieToEdit->setNumeroLicence($newNumeroLicence);
                        $licencieToEdit->setNom($newNom);
                        $licencieToEdit->setPrenom($newPrenom);
                        $licencieToEdit->setContact($contact);
                        $licencieToEdit->setCategorie($categorie);
        
                        $success = $this->licencieDAO->update($licencieToEdit);
        
                        if ($success) {
                            // Redirection après l'édition réussie
                            header('Location: index.php?page=licencie&action=index');
                            exit();
                        } else {
                            echo "Erreur lors de la mise à jour du licencié";
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
        
            // Passer le licencié à la vue
            include 'views/LicencieEdit.php';
        }
        
        
        public function delete($id)
        {
                // Récupérer le licencié à supprimer depuis la base de données
            $licencieToDelete = $this->licencieDAO->getById($id);

            // Vérifier si le licencié existe
            if (!$licencieToDelete) {
                echo "Licencié non trouvé";
            exit();
        }

    // Supprimer le licencié de la base de données
    $success = $this->licencieDAO->delete($licencieToDelete);

    if ($success) {
        // Redirection après la suppression réussie
        header('Location: index.php?page=licencie&action=index');
        exit();
    } else {
        echo "Erreur lors de la suppression du licencié";
        exit();
    }
}


        public function getAllWithContacts() {
            try {
                $stmt = $this->connexion->getPDO()->query("SELECT l.*, c.nom as categorie_nom, co.* FROM licencies l LEFT JOIN contacts co ON l.id_contact = co.id_contact LEFT JOIN categories c ON l.id_categorie = c.id_categorie");
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
                $licencies = [];
        
                foreach ($result as $row) {
                    $licencie = new Licencie();
                    $licencie->setId($row['id_licencie']);
                    $licencie->setNumeroLicence($row['numero_licence']);
                    $licencie->setNom($row['nom']);
                    $licencie->setPrenom($row['prenom']);
        
                    // Create a new Contact object and set its properties
                    $contact = new Contact();
                    $contact->setId($row['id_contact']);
                    $contact->setNom($row['nom']);
                    $contact->setPrenom($row['prenom']);
                    $contact->setEmail($row['email']);
                    $contact->setNumeroTel($row['numero_tel']);
        
                    // Set the Contact object for the Licencie
                    $licencie->setContact($contact);
        
                    // Create a new Categorie object and set its properties
                    $categorie = new Categorie();
                    $categorie->setNom($row['categorie_nom']); // Change this line based on your actual column name
        
                    // Set the Categorie object for the Licencie
                    $licencie->setCategorie($categorie);
        
                    $licencies[] = $licencie;
                }
        
                return $licencies;
            } catch (PDOException $e) {
                // Handle exceptions
                return [];
            }
        }
        
        

        public function getById($id) {
            try {
                $stmt = $this->connexion->getPDO()->prepare("SELECT * FROM licencies WHERE id_licencie = ?");
                $stmt->execute([$id]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
                if ($row) {
                    $licencie = new Licencie();
                    $licencie->setId($row['id_licencie']);
                    $licencie->setNumeroLicence($row['numero_licence']);
                    // Set other properties
                    return $licencie;
                } else {
                    return null; // Handle the case where no results are found
                }
            } catch (PDOException $e) {
                // Handle exceptions
                return null;
            }
        }
        

    public function saveLicencie(Licencie $licencie) {
        // Enregistrer un nouveau licencié
        $success = $this->licencieDAO->save($licencie);

        // Retourner le succès de l'opération
        return $success;
    }

    public function updateLicencie(Licencie $licencie) {
        // Mettre à jour un licencié existant
        $success = $this->licencieDAO->update($licencie);

        // Retourner le succès de l'opération
        return $success;
    }

    public function deleteLicencie(Licencie $licencie) {
        // Supprimer un licencié
        $success = $this->licencieDAO->delete($licencie);

        // Retourner le succès de l'opération
        return $success;
    }
}
?>