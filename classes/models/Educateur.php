<?php 

class Educateur extends Licencie {

    private $email;
    private $motDePasse;
    private $isAdmin;

    public function __construct($numeroLicence, $nom, $prenom, $categorie, $contact, $email, $motDePasse, $isAdmin, $id = null) {
        parent::__construct($id, $numeroLicence, $nom, $prenom, $categorie, $contact);
        $this->email = $email;
        $this->motDePasse = $motDePasse;
        $this->isAdmin = $isAdmin;
    }

    public function getEmail(): string {
        return $this->email;
    }
    
    public function setEmail(string $email): void {
        // Validation de l'e-mail
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
        } else {
            throw new InvalidArgumentException("L'adresse e-mail n'est pas valide.");
        }
    }
    

    public function getMotDePasse(): string {
        return $this->motDePasse;
    }

    public function setMotDePasse(string $motDePasse): void {
        // Validation du mot de passe (exemple : longueur minimale de 8 caractères)
        if (strlen($motDePasse) >= 8) {
            $this->motDePasse = $motDePasse;
        } else {
            throw new InvalidArgumentException("Le mot de passe doit avoir au moins 8 caractères.");
        }
    }
    

    public function isAdmin(): bool {
        return $this->isAdmin;
    }

    public function getAdmin(): bool{
        return $this->isAdmin;
    }

    public function setAdmin(bool $isAdmin): void {
        $this->isAdmin = $isAdmin;
    }
}

?>