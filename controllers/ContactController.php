<?php

class ContactController {
private $contactDAO;

public function __construct(ContactDAO $contactDAO) {
$this->contactDAO = $contactDAO;
}
public function index() {
    // Récupérer toutes les catégories
    $contacts = $this->getAllContacts();

    // Inclure la vue pour afficher le tableau des catégories
    include('views/ContactView.php');
}

public function add()
{

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $newNom = $_POST['nom'] ?? null;
        $newPrenom = $_POST['prenom'] ?? null;
        $newEmail = $_POST['email'] ?? null;
        $newNumeroTel = $_POST['numero_tel'] ?? null;

        // Check if all required data is present
        if ($newNom && $newPrenom && $newEmail && $newNumeroTel) {

            $newContact = new Contact($newNom, $newPrenom, $newEmail, $newNumeroTel);

            $success = $this->contactDAO->save($newContact);

            if ($success) {

                header('Location: index.php?page=contact&action=index');
                exit();
            } else {
                echo "Erreur lors de l'ajout du contact";
                exit();
            }
        } else {
            echo "Donnée.s manquante.s";
            exit();
        }
    }

    // Display the contact add form
    include 'views/ContactAdd.php';
}

public function edit($id)
{
    // Récupérer le contact à éditer depuis la base de données
    $contactToEdit = $this->contactDAO->getById($id);

    // Vérifier si le contact existe
    if (!$contactToEdit) {
        echo "Contact non trouvé";
        exit();
    }

    // Traitement du formulaire de modification (si le formulaire est soumis)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer les données du formulaire
        $newNom = isset($_POST['nom']) ? $_POST['nom'] : null;
        $newPrenom = isset($_POST['prenom']) ? $_POST['prenom'] : null;
        $newEmail = isset($_POST['email']) ? $_POST['email'] : null;
        $newNumeroTel = isset($_POST['numero_tel']) ? $_POST['numero_tel'] : null;

        // Vérifier si les données nécessaires sont présentes
        if ($newNom !== null && $newPrenom !== null && $newEmail !== null && $newNumeroTel !== null) {
            // Mettre à jour le contact dans la base de données
            $contactToEdit->setNom($newNom);
            $contactToEdit->setPrenom($newPrenom);
            $contactToEdit->setEmail($newEmail);
            $contactToEdit->setNumeroTel($newNumeroTel);

            $success = $this->contactDAO->update($contactToEdit);

            if ($success) {
                // Redirection après l'édition réussie
                header('Location: index.php?page=contact&action=index');
                exit();
            } else {
                echo "Erreur lors de la mise à jour du contact";
                exit();
            }
        } else {
            echo "Données du formulaire manquantes";
            exit();
        }
    }

    // Passer le contact à la vue
    include 'views/ContactEdit.php';
}

public function delete($id)
{
        // Récupérer le licencié à supprimer depuis la base de données
    $contactToDelete = $this->contactDAO->getById($id);

    // Vérifier si le licencié existe
    if (!$contactToDelete) {
        echo "Contact non trouvé";
    exit();
}

// Supprimer le licencié de la base de données
$success = $this->contactDAO->delete($contactToDelete);

if ($success) {
// Redirection après la suppression réussie
header('Location: index.php?page=contact&action=index');
exit();
} else {
echo "Erreur lors de la suppression du contact";
exit();
}
}

public function getAllContacts() {
// Récupérer tous les contacts
$contacts = $this->contactDAO->getAll();

// Retourner les contacts (peut être utilisé pour affichage, etc.)
return $contacts;
}

public function getContactById($id) {
// Récupérer un contact par son ID
$contact = $this->contactDAO->getById($id);

// Retourner le contact (peut être utilisé pour affichage, etc.)
return $contact;
}

public function saveContact(Contact $contact) {
// Enregistrer un nouveau contact
$success = $this->contactDAO->save($contact);

// Retourner le succès de l'opération
return $success;
}

public function updateContact(Contact $contact) {
// Mettre à jour un contact existant
$success = $this->contactDAO->update($contact);

// Retourner le succès de l'opération
return $success;
}

public function deleteContact(Contact $contact) {
// Supprimer un contact
$success = $this->contactDAO->delete($contact);

// Retourner le succès de l'opération
return $success;
}
}

?>