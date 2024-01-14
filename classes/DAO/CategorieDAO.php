<?php

class CategorieDAO {
    private $connexion;

    public function __construct(Connexion $connexion) {
        $this->connexion = $connexion;
    }

    // Méthode pour enregistrer la catégorie dans la base de données
    public function save(Categorie $categorie) {
        try {
            $stmt = $this->connexion->getPDO()->prepare("INSERT INTO categories (nom, code_raccourci) VALUES (?, ?)");
            $stmt->execute([$categorie->getNom(), $categorie->getCodeRaccourci()]);
            return true;
        } catch (PDOException $e) {
            // Gérer les erreurs d'insertion ici
            return false;
        }
    }

    // Méthode pour mettre à jour la catégorie dans la base de données
    public function update(Categorie $categorie) {
        try {
            $stmt = $this->connexion->getPDO()->prepare("UPDATE categories SET nom = ?, code_raccourci = ? WHERE id_categorie = ?");
            $stmt->execute([$categorie->getNom(), $categorie->getCodeRaccourci(), $categorie->getId()]);
            return true;
        } catch (PDOException $e) {
            // Gérer les erreurs de mise à jour ici
            return false;
        }
    }

    // Méthode pour supprimer la catégorie de la base de données
    public function delete(Categorie $categorie) {
        try {
            $stmt = $this->connexion->getPDO()->prepare("DELETE FROM categories WHERE id_categorie = ?");
            $stmt->execute([$categorie->getId()]);
            return true;
        } catch (PDOException $e) {
            // Gérer les erreurs de suppression ici
            return false;
        }
    }

    // Méthode pour récupérer toutes les catégories de la base de données
    public function getAll() {
        try {
            $stmt = $this->connexion->getPDO()->query("SELECT * FROM categories");
            $categories = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $categories[] = $this->createCategorieFromRow($row);
            }

            return $categories;
        } catch (PDOException $e) {
            // Gérer les erreurs de récupération ici
            return [];
        }
    }

    public function getById($id) {
        try {
            $stmt = $this->connexion->getPDO()->prepare("SELECT * FROM categories WHERE id_categorie = ?");
            $stmt->execute([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                return $this->createCategorieFromRow($row);
            } else {
                return null; // Ajustez le comportement en fonction de votre application
            }
        } catch (PDOException $e) {
            // Gérer les erreurs de récupération ici
            return null;
        }
    }

    private function createCategorieFromRow($row) {
        $categorie = new Categorie();
        $categorie->setId($row['id_categorie']);
        $categorie->setNom($row['nom']);
        $categorie->setCodeRaccourci($row['code_raccourci']);
        return $categorie;
    }
}

?>