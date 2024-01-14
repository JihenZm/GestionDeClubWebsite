<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Gestion des Catégories</title>
</head>

<body>
    <h1>Gestion des Catégories</h1>
    <a href="index.php?page=home">Retour à l'acceuil</a>

    <!-- Bouton pour créer une catégorie -->
    <a href="index.php?page=categorie&action=add">Créer une nouvelle catégorie</a>

    <!-- Tableau des catégories -->
    <h2>Liste des Catégories</h2>
    <?php if (!empty($categories)): ?>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Code Raccourci</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($categories as $categorie): ?>
        <tr>
            <td><?php echo $categorie->getId(); ?></td>
            <td><?php echo $categorie->getNom(); ?></td>
            <td><?php echo $categorie->getCodeRaccourci(); ?></td>
            <td>
                <a href="index.php?page=categorie&action=edit&id=<?php echo $categorie->getId(); ?>">Modifier</a>
                <a href="index.php?page=categorie&action=delete&id=<?php echo $categorie->getId(); ?>">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php else: ?>
    <p>Aucune catégorie disponible.</p>
    <?php endif; ?>

</body>

</html>