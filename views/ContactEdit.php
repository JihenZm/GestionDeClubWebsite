<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Édition de Contact</title>
</head>

<body>
    <h1>Édition de Contact</h1>

    <?php if ($contactToEdit): ?>
    <form method="post" action="index.php?page=contact&action=edit&id=<?php echo $contactToEdit->getId(); ?>">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" value="<?php echo $contactToEdit->getNom(); ?>" required>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" value="<?php echo $contactToEdit->getPrenom(); ?>" required>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" value="<?php echo $contactToEdit->getEmail(); ?>" required>

        <label for="numero_tel">Numéro de téléphone :</label>
        <input type="text" id="numero_tel" name="numero_tel" value="<?php echo $contactToEdit->getNumeroTel(); ?>"
            required>

        <!-- Ajoutez d'autres champs d'édition ici selon vos besoins -->

        <button type="submit">Enregistrer les modifications</button>
    </form>
    <?php else: ?>
    <p>Contact non trouvé.</p>
    <?php endif; ?>

</body>

</html>