<?php

class ContactDAO {
    private $connexion;

    public function __construct(Connexion $connexion) {
        $this->connexion = $connexion;
    }

    // Méthode pour enregistrer le contact dans la base de données
    public function save(Contact $contact) {
        try {
            $sql = "INSERT INTO contacts (nom, prenom, email, numero_tel) VALUES (?, ?, ?, ?)";
            $stmt = $this->connexion->getPDO()->prepare($sql);
            $stmt->execute([$contact->getNom(), $contact->getPrenom(), $contact->getEmail(), $contact->getNumeroTel()]);
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    

    // Méthode pour mettre à jour le contact dans la base de données
    public function update(Contact $contact) {
        try {
            $stmt = $this->connexion->getPDO()->prepare("UPDATE contacts SET nom = ?, prenom = ?, email = ?, numero_tel = ? WHERE id_contact = ?");
            $stmt->execute([$contact->getNom(), $contact->getPrenom(), $contact->getEmail(), $contact->getNumeroTel(), $contact->getId()]);
            return true;
        } catch (PDOException $e) {
            // Gérer les erreurs de mise à jour ici
            return false;
        }
    }

    // Méthode pour supprimer le contact de la base de données
    public function delete(Contact $contact) {
        try {
            $stmt = $this->connexion->getPDO()->prepare("DELETE FROM contacts WHERE id_contact = ?");
            $stmt->execute([$contact->getId()]);
            return true;
        } catch (PDOException $e) {
            // Gérer les erreurs de suppression ici
            return false;
        }
    }

    public function getById($id) {
        try {
            $stmt = $this->connexion->getPDO()->prepare("SELECT * FROM contacts WHERE id_contact = ?");
            $stmt->execute([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                return $this->createContactFromRow($row);
            } else {
                return null; // Ajustez le comportement en fonction de votre application
            }
        } catch (PDOException $e) {
            // Gérer les erreurs de récupération ici
            return null;
        }
    }

    public function getAll() {
        try {
            $stmt = $this->connexion->getPDO()->query("SELECT * FROM contacts");
            $contacts = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $contacts[] = $this->createContactFromRow($row);
            }

            return $contacts;
        } catch (PDOException $e) {
            // Gérer les erreurs de récupération ici
            return [];
        }
    }

    private function createContactFromRow($row) {
        $contact = new Contact();
        $contact->setId($row['id_contact']);
        $contact->setNom($row['nom']);
        $contact->setPrenom($row['prenom']);
        $contact->setEmail($row['email']);
        $contact->setNumeroTel($row['numero_tel']);
        return $contact;
    }
}

?>