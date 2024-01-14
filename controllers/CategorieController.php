<?php

class CategorieController {
    private $categorieDAO;

    public function __construct(CategorieDAO $categorieDAO) {
        $this->categorieDAO = $categorieDAO;
    }
    
    public function index() {
        // Récupérer toutes les catégories
        $categories = $this->getAllCategories();
    
        // Inclure la vue pour afficher le tableau des catégories
        include('views/CategorieView.php');
    }    
    
    public function edit($id)
    {
        // Récupérer la catégorie à éditer depuis la base de données
        $categoryToEdit = $this->categorieDAO->getById($id);

        // Vérifier si la catégorie existe
        if (!$categoryToEdit) {
            echo "Catégorie non trouvée";
            exit();
        }

        // Traitement du formulaire de modification (si le formulaire est soumis)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $newName = isset($_POST['nom']) ? $_POST['nom'] : null;
            $newCodeRaccourci = isset($_POST['code_raccourci']) ? $_POST['code_raccourci'] : null;

            // Vérifier si les données nécessaires sont présentes
            if ($newName !== null && $newCodeRaccourci !== null) {
                // Mettre à jour la catégorie dans la base de données
                $categoryToEdit->setNom($newName);
                $categoryToEdit->setCodeRaccourci($newCodeRaccourci);

                $success = $this->categorieDAO->update($categoryToEdit);

                if ($success) {
                    // Redirection après l'édition réussie
                    header('Location: index.php?page=categorie&action=index');
                    exit();
                } else {
                    echo "Erreur lors de la mise à jour de la catégorie";
                    exit();
                }
            } else {
                echo "Données du formulaire manquantes";
                exit();
            }
        }

        // Passer la catégorie à la vue
        include 'views/CategorieEdit.php';
    }
    

    public function add()
    {
        // Traitement du formulaire d'ajout (si le formulaire est soumis)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $newName = isset($_POST['nom']) ? $_POST['nom'] : null;
            $newCodeRaccourci = isset($_POST['code_raccourci']) ? $_POST['code_raccourci'] : null;

            // Vérifier si les données nécessaires sont présentes
            if ($newName !== null && $newCodeRaccourci !== null) {
                // Créer une nouvelle catégorie
                $newCategory = new Categorie();
                $newCategory->setNom($newName);
                $newCategory->setCodeRaccourci($newCodeRaccourci);

                // Ajouter la nouvelle catégorie dans la base de données
                $success = $this->categorieDAO->save($newCategory);

                if ($success) {
                    // Redirection après l'ajout réussi
                    header('Location: index.php?page=categorie&action=index');
                    exit();
                } else {
                    echo "Erreur lors de l'ajout de la catégorie";
                    exit();
                }
            } else {
                echo "Données du formulaire manquantes";
                exit();
            }
        }

        // Afficher le formulaire d'ajout de catégorie
        include 'views/CategorieAdd.php';
    }

    public function delete($id)
    {
        // Récupérer la catégorie à supprimer depuis la base de données
        $categoryToDelete = $this->categorieDAO->getById($id);

        // Vérifier si la catégorie existe
        if (!$categoryToDelete) {
            echo "Catégorie non trouvée";
            exit();
        }

        // Supprimer la catégorie de la base de données
        $success = $this->categorieDAO->delete($categoryToDelete);

        if ($success) {
            // Redirection après la suppression réussie
            header('Location: index.php?page=categorie&action=index');
            exit();
        } else {
            echo "Erreur lors de la suppression de la catégorie";
            exit();
        }
    }

    public function getAllCategories() {
        // Récupérer toutes les catégories
        $categories = $this->categorieDAO->getAll();

        // Retourner les catégories (peut être utilisé pour affichage, etc.)
        return $categories;
    }

    public function getCategoryById($id) {
        // Récupérer une catégorie par son ID
        $categorie = $this->categorieDAO->getById($id);

        // Retourner la catégorie (peut être utilisée pour affichage, etc.)
        return $categorie;
    }

    public function saveCategory(Categorie $categorie) {
        // Enregistrer une nouvelle catégorie
        $success = $this->categorieDAO->save($categorie);

        // Retourner le succès de l'opération
        return $success;
    }

    public function updateCategory(Categorie $categorie) {
        // Mettre à jour une catégorie existante
        $success = $this->categorieDAO->update($categorie);

        // Retourner le succès de l'opération
        return $success;
    }

    public function deleteCategory(Categorie $categorie) {
        // Supprimer une catégorie
        $success = $this->categorieDAO->delete($categorie);

        // Retourner le succès de l'opération
        return $success;
    }
}

?>