<?php

class LoginController {
    
    // Méthode pour afficher le formulaire de connexion
    public function index() {
        // Affiche le formulaire de connexion
        require_once('views/login.php');
    }

    // Méthode pour traiter le formulaire de connexion
    public function login() {
        // Vérifie si les champs email et password sont présents dans la requête POST
        if (isset($_POST['email']) && isset($_POST['password'])) {
            // Récupère les valeurs du formulaire
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            // Votre logique d'authentification ici (remplacez cet exemple par votre propre logique)
            if ($this->authenticate($email, $password)) {
                // Authentification réussie, rediriger ou afficher un message de succès
                header('Location: index.php?page=home');
                echo "Connexion réussie!";
                exit();
            } else {
                // Authentification échouée, rediriger vers le formulaire de connexion avec un message d'erreur
                echo "Authentification échouée!";
                header('Location: index.php?page=login&action=index&error=auth_failed');
                exit();
            }
            
        } else {
            // Les champs email et password ne sont pas présents dans la requête POST, rediriger vers le formulaire de connexion
            header('Location: index.php?page=login&action=index');
            exit();
        }
    }

    private function authenticate($email, $password) {
        // Instancier la classe AuthService avec la connexion à la base de données
        $authService = new AuthService(new Connexion('localhost','clubsportifdb','root',''));

        // Appeler la méthode authenticate de la classe AuthService
        $educateur = $authService->authenticate($email, $password);

        // Vérifier si l'éducateur existe
        if ($educateur) {
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