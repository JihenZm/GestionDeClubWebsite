<!-- views/LicencieAdd.php -->

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajout de Licencié</title>
</head>

<body>
    <h1>Ajout de Licencié</h1>

    <form method="post" action="index.php?page=licencie&action=add">
        <label for="numero_licence">Numéro de licence :</label>
        <input type="text" id="numero_licence" name="numero_licence" required>

        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required>

        <label for="categorie">ID de la categorie :</label>
        <input type="text" id="categorie" name="categorie" required>

        <label for="contact">ID du contact :</label>
        <input type="text" id="contact" name="contact" required>


        <!-- Other form fields for additional information -->

        <button type="submit">Ajouter le licencié</button>
    </form>

</body>

</html>