<?php


class AuthService {
    private $connexion;

    public function __construct(Connexion $connexion) {
        $this->connexion = $connexion;
    }

    public function isEducateurAuthenticated() {
        // Vérifie si l'éducateur est authentifié
        return isset($_SESSION['educateur']);
    }

    public function authenticate($email, $password) {
        // Requête SQL pour récupérer l'éducateur basé sur l'e-mail
        $query = "SELECT * FROM educateurs WHERE email = :email";
        $stmt = $this->connexion->getPDO()->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        
        try {
            $stmt->execute();
            $educateur = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de l'exécution de la requête: " . $e->getMessage();
            return false;
        }

        // Vérifie si l'éducateur existe et si le mot de passe correspond
        if ($educateur && $password === $educateur['mot_de_passe']) {
            // Stocker des informations sur l'éducateur dans la session si nécessaire
            $_SESSION['educateur'] = $educateur;
            
            // Authentification réussie
            return true;
        } else {
            // Authentification échouée
            return false;
        }
    }
}



?>