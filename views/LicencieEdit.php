<!-- views/LicencieEdit.php -->

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Édition de Licencié</title>
</head>

<body>
    <h1>Édition de Licencié</h1>

    <?php if ($licencieToEdit): ?>
    <form method="post" action="index.php?page=licencie&action=edit&id=<?php echo $licencieToEdit->getId(); ?>">
        <label for="numero_licence">Numéro de licence :</label>
        <input type="text" id="numero_licence" name="numero_licence"
            value="<?php echo $licencieToEdit->getNumeroLicence(); ?>" required>

        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" value="<?php echo $licencieToEdit->getNom(); ?>" required>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" value="<?php echo $licencieToEdit->getPrenom(); ?>" required>

        <label for="contact">ID du contact :</label>
        <input type="text" id="contact" name="contact" value="<?php echo $licencieToEdit->getContact()->getId(); ?>"
            required>

        <label for="categorie">ID de la catégorie :</label>
        <input type="text" id="categorie" name="categorie"
            value="<?php echo $licencieToEdit->getCategorie()->getId(); ?>" required>
        <!-- Ajoutez d'autres champs d'édition ici selon vos besoins -->

        <button type="submit">Enregistrer les modifications</button>
    </form>
    <?php else: ?>
    <p>Licencié non trouvé.</p>
    <?php endif; ?>

</body>

</html>