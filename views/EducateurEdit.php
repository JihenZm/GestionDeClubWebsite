<!-- views/EducateurEdit.php -->

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Édition d'Éducateur</title>
</head>

<body>
    <h1>Édition d'Éducateur</h1>

    <?php if ($educateurToEdit): ?>
    <form method="post" action="index.php?page=educateur&action=edit&id=<?php echo $educateurToEdit->getId(); ?>">
        <label for="numero_licence">Numéro de licence :</label>
        <input type="text" id="numero_licence" name="numero_licence"
            value="<?php echo $educateurToEdit->getNumeroLicence(); ?>" required>

        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" value="<?php echo $educateurToEdit->getNom(); ?>" required>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" value="<?php echo $educateurToEdit->getPrenom(); ?>" required>

        <label for="contact">ID du contact :</label>
        <input type="text" id="contact" name="contact" value="<?php echo $educateurToEdit->getContact()->getId(); ?>"
            required>

        <label for="categorie">ID de la catégorie :</label>
        <input type="text" id="categorie" name="categorie"
            value="<?php echo $educateurToEdit->getCategorie()->getId(); ?>" required>

        <!-- Ajouter des champs spécifiques aux éducateurs -->
        <label for="email">Email :</label>
        <input type="text" id="email" name="email" value="<?php echo $educateurToEdit->getEmail(); ?>" required>

        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe" required>

        <label for="is_admin">Administrateur :</label>
        <input type="checkbox" id="is_admin" name="is_admin" <?php echo ($educateurToEdit->isAdmin()) ? 'checked' : ''; ?>>
        <!-- Ajouter d'autres champs d'édition ici selon vos besoins -->

        <button type="submit">Enregistrer les modifications</button>
    </form>
    <?php else: ?>
    <p>Éducateur non trouvé.</p>
    <?php endif; ?>

</body>

</html>
