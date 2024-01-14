<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajout de Contact</title>
</head>

<body>
    <h1>Ajout de Contact</h1>

    <form method="post" action="index.php?page=contact&action=add">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>

        <label for="numero_tel">Numéro de téléphone :</label>
        <input type="text" id="numero_tel" name="numero_tel" required>

        <button type="submit">Ajouter le contact</button>
    </form>

</body>

</html>