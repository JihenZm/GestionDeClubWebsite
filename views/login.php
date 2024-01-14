<!-- login.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>

<body>
    <h2>Connexion</h2>

    <?php
    // Affiche un message d'erreur si l'authentification a échoué
    if (isset($_GET['error']) && $_GET['error'] === 'Unauthorized') {
        echo '<p class="error">Échec de l\'authentification. Veuillez vérifier vos informations d\'identification.</p>';
    }
    ?>

    <form method="post" action="index.php?page=login&action=login">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>

        <label for="password">Mot de passe:</label>
        <input type="password" name="password" id="password" required>

        <input type="submit" name="login" value="Se connecter">
    </form>
</body>

</html>