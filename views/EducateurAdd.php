<!-- views/EducateurAdd.php -->

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajout d'Éducateur</title>
</head>

<body>
    <h1>Ajout d'Éducateur</h1>

    <form method="post" action="index.php?page=educateur&action=add">
        <label for="numero_licence">Numéro de licence :</label>
        <input type="text" id="numero_licence" name="numero_licence" required>

        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required>

        <label for="categorie_id">ID de la catégorie :</label>
        <input type="text" id="categorie_id" name="categorie_id" required>

        <label for="contact_id">ID du contact :</label>
        <input type="text" id="contact_id" name="contact_id" required>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>

        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe" required>

        <label for="is_admin">isAdmin :</label>
        <input type="checkbox" id="is_admin" name="is_admin">

        <!-- Autres champs d'information supplémentaires -->

        <button type="submit">Ajouter l'éducateur</button>
    </form>

</body>

</html>
