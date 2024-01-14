<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Gestion des Éducateurs</title>
</head>

<body>
    <h1>Gestion des Éducateurs</h1>
    <a href="index.php?page=home">Retour à l'accueil</a>

    <!-- Bouton pour créer un nouvel éducateur -->
    <a href="index.php?page=educateur&action=add">Créer un nouvel éducateur</a>

    <h2>Liste des éducateurs</h2>
    <?php if (!empty($educateurs)): ?>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Numéro de licence</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Catégorie</th>
            <th>Email</th>
            <th>Numéro de téléphone</th>
            <th>Mot de passe</th>
            <th>isAdmin</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($educateurs as $educateur): ?>
        <tr>
            <td><?php echo $educateur->getId(); ?></td>
            <td><?php echo $educateur->getNumeroLicence(); ?></td>
            <td><?php echo $educateur->getNom(); ?></td>
            <td><?php echo $educateur->getPrenom(); ?></td>
            <td>
                <?php
                $categorie = $educateur->getCategorie();
                echo ($categorie !== null) ? $categorie->getNom() : 'N/A';
                ?>
            </td>
            <?php
            $contact = $educateur->getContact();
            if ($contact !== null) {
                echo '<td>' . $contact->getEmail() . '</td>';
                echo '<td>' . $contact->getNumeroTel() . '</td>';
            } else {
                echo '<td>N/A</td>';
                echo '<td>N/A</td>';
            }
            ?>
            <td><?php echo $educateur->getMotDePasse(); ?></td>
            <td><?php echo ($educateur->isAdmin()) ? 'Oui' : 'Non'; ?></td>
            <td>
                <a href="index.php?page=educateur&action=edit&id=<?php echo $educateur->getId(); ?>">Modifier</a>
                <a href="index.php?page=educateur&action=delete&id=<?php echo $educateur->getId(); ?>">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>

    </table>
    <?php else: ?>
    <p>Aucun éducateur disponible.</p>
    <?php endif; ?>

</body>

</html>
