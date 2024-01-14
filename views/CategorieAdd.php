<!-- views/CategorieAdd.php -->

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajout de Catégorie</title>
</head>

<body>
    <h1>Ajout de Catégorie</h1>

    <form method="post" action="index.php?page=categorie&action=add">
        <label for="nom">Nom de la catégorie :</label>
        <input type="text" id="nom" name="nom" required>

        <label for="code_raccourci">Code Raccourci :</label>
        <input type="text" id="code_raccourci" name="code_raccourci" required>

        <!-- Autres champs du formulaire -->

        <button type="submit">Ajouter la catégorie</button>
    </form>

</body>

</html>