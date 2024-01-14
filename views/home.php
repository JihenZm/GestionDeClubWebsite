<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Club Sportif</title>
    <!-- Ajoutez ici vos liens CSS ou styles pour la mise en forme -->
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>

    <header>
        <h1>Club Sportif</h1>
        <nav>
            <ul>
                <li><a href="index.php?page=categorie">Catégories</a></li>
                <li><a href="index.php?page=licencie">Licenciés</a></li>
                <li><a href="index.php?page=educateur">Éducateurs</a></li>
                <li><a href="index.php?page=contact">Contacts</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <?php
        
            // Inclure le fichier de configuration et les classes nécessaires
            require_once('config.php');
            require_once('classes/models/Categorie.php');
            require_once('classes/models/Licencie.php');
            require_once('classes/models/Contact.php');
            require_once('classes/models/Educateur.php');
            require_once('classes/models/Connexion.php');
            require_once('classes/dao/CategorieDAO.php');
            require_once('classes/dao/ContactDAO.php');
            require_once('classes/dao/LicencieDAO.php');
            require_once('classes/dao/EducateurDAO.php');

            // Instancier les DAO avec une connexion
            $connexion = new Connexion('localhost', 'clubsportifdb', 'root', '');
            $categorieDAO = new CategorieDAO($connexion);
            $contactDAO = new ContactDAO($connexion);
            $licencieDAO = new LicencieDAO($connexion, $categorieDAO, $contactDAO);
            $educateurDAO = new EducateurDAO($connexion, $categorieDAO, $contactDAO);

            // Exemple de logique pour accéder aux contrôleurs en fonction de la page
            if (isset($_GET['page'])) {
                $page = $_GET['page'];

                // Utilisez une logique de routage pour rediriger vers les contrôleurs
                switch ($page) {
                    case 'categorie':
                        // Instancier le contrôleur pour la page "categories"
                        // Appeler la méthode nécessaire du contrôleur
                        $controller = new CategorieController($categorieDAO);
                        $controller->index();
                        break;

                    case 'contact':
                        // Instancier le contrôleur pour la page "categories"
                        // Appeler la méthode nécessaire du contrôleur
                        $controller = new ContactController($contactDAO);
                        $controller->index();
                        break;
                    // Ajoutez d'autres cas pour d'autres pages si nécessaire
                    default:
                        // Gestion d'une page inconnue
                        //echo "Page inconnue";
                        break;
                }
            }
        ?>
    </main>

    <footer>
        <p>&copy; 2024 Club Sportif. Tous droits réservés.</p>
    </footer>

</body>

</html>