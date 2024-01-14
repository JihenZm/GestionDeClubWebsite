<!-- views/CategorieEdit.php -->

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Édition de Catégorie</title>
</head>

<body>
    <h1>Édition de Catégorie</h1>

    <?php if ($categoryToEdit): ?>
    <form method="post" action="index.php?page=categorie&action=edit&id=<?php echo $categoryToEdit->getId(); ?>">
        <label for="nom">Nom de la catégorie :</label>
        <input type="text" id="nom" name="nom" value="<?php echo $categoryToEdit->getNom(); ?>" required>
        <label for="code_raccourci">Code Raccourci :</label>
        <input type="text" id="code_raccourci" name="code_raccourci"
            value="<?php echo $categoryToEdit->getCodeRaccourci(); ?>" required>
        <!-- Ajoutez d'autres champs d'édition ici selon vos besoins -->

        <button type="submit">Enregistrer les modifications</button>
    </form>
    <?php else: ?>
    <p>Catégorie non trouvée.</p>
    <?php endif; ?>

</body>

</html>