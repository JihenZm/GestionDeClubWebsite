<?php

class LicencieDAO {
    private $connexion;
    private $categorieDAO;
    private $contactDAO;

    public function __construct(Connexion $connexion, CategorieDAO $categorieDAO, ContactDAO $contactDAO) {
        $this->connexion = $connexion;
        $this->categorieDAO = $categorieDAO;
        $this->contactDAO = $contactDAO;
    }

    public function save(Licencie $licencie) {
        try {
            $sql = "INSERT INTO licencies (numero_licence, nom, prenom, id_contact, id_categorie) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->connexion->getPDO()->prepare($sql);
    
            $categorieId = ($licencie->getCategorie() !== null) ? $licencie->getCategorie()->getId() : null;
            $contactId = ($licencie->getContact() !== null) ? $licencie->getContact()->getId() : null;
    
            // Ajustez l'ordre des valeurs dans le tableau passé à execute
            $stmt->execute([$licencie->getNumeroLicence(), $licencie->getNom(), $licencie->getPrenom(), $contactId, $categorieId]);
    
            return true;
        } catch (PDOException $e) {
            // Afficher le message d'erreur pour le débogage
            echo "Erreur d'insertion : " . $e->getMessage();
            return false;
        }
    }
    
    
    
    
    

// Méthode pour mettre à jour le licencie dans la base de données
public function update(Licencie $licencie) {
    try {
        $sql = "UPDATE licencies SET numero_licence = ?, nom = ?, prenom = ?, id_contact = ?, id_categorie = ? WHERE id_licencie = ?";
        $stmt = $this->connexion->getPDO()->prepare($sql);

        $categorieId = ($licencie->getCategorie() !== null) ? $licencie->getCategorie()->getId() : null;
        $contactId = ($licencie->getContact() !== null) ? $licencie->getContact()->getId() : null;

        $stmt->execute([$licencie->getNumeroLicence(), $licencie->getNom(), $licencie->getPrenom(), $contactId, $categorieId, $licencie->getId()]);

        return true;
    } catch (PDOException $e) {
        // Gérer les erreurs de mise à jour ici
        return false;
    }
}


    

    // Méthode pour supprimer le licencie de la base de données
    public function delete(Licencie $licencie) {
        try {
            $sql = "DELETE FROM licencies WHERE id_licencie = ?";
            $stmt = $this->connexion->getPDO()->prepare($sql);
            $stmt->execute([$licencie->getId()]);
            return true;
        } catch (PDOException $e) {
            // Gérer les erreurs de suppression ici
            return false;
        }
    }

    // Méthode pour récupérer tous les licencies de la base de données
    public function getAll() {
        try {
            $stmt = $this->connexion->getPDO()->query("SELECT * FROM licencies");
            $licencies = [];
    
            if ($stmt->execute()) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $categorie = isset($row['id_categorie']) ? $this->categorieDAO->getById($row['id_categorie']) : null;
                    $contact = isset($row['id_contact']) ? $this->contactDAO->getById($row['id_contact']) : null;
                
                    $licencie = new Licencie(
                        $row['id_licencie'],
                        $row['numero_licence'],
                        $row['nom'],
                        $row['prenom'],
                        $contact,
                        $categorie,
                    );
    
                    $licencies[] = $licencie;
                }
            }
    
            return $licencies;
        } catch (PDOException $e) {
            // Gérer les erreurs de récupération ici
            return [];
        }
    }
    
    

    public function getById($id) :?Licencie{
        try {
            $stmt = $this->connexion->getPDO()->prepare("SELECT * FROM licencies WHERE id_licencie = ?");
            $stmt->execute([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($row) {
                // Récupérer l'objet Categorie à partir de son ID
                $categorie = isset($row['id_categorie']) ? $this->categorieDAO->getById($row['id_categorie']) : null;
    
                // Récupérer l'objet Contact à partir de son ID
                $contact = isset($row['id_contact']) ? $this->contactDAO->getById($row['id_contact']) : null;
    
                $licencie = new Licencie(
                    $row['id_licencie'],
                    $row['numero_licence'],
                    $row['nom'],
                    $row['prenom'],
                    $categorie,
                    $contact
                );
                return $licencie;
            } else {
                return null; // Ajustez le comportement en fonction de votre application
            }
        } catch (PDOException $e) {
            // Gérer les erreurs de récupération ici
            return null;
        }
    }
    
    
    

}

?>