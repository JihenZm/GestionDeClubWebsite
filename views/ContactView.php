<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Gestion des Contacts</title>
</head>

<body>
    <h1>Gestion des Contacts</h1>
    <a href="index.php?page=home">Retour à l'accueil</a>

    <!-- Bouton pour créer un nouveau contact -->
    <a href="index.php?page=contact&action=add">Créer un nouveau contact</a>

    <h2>Liste des contacts</h2>
    <?php if (!empty($contacts)): ?>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Numéro de téléphone</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($contacts as $contact): ?>
        <tr>
            <td><?php echo $contact->getId(); ?></td>
            <td><?php echo $contact->getNom(); ?></td>
            <td><?php echo $contact->getPrenom(); ?></td>
            <td><?php echo $contact->getEmail(); ?></td>
            <td><?php echo $contact->getNumeroTel(); ?></td>
            <td>
                <a href="index.php?page=contact&action=edit&id=<?php echo $contact->getId(); ?>">Modifier</a>
                <a href="index.php?page=contact&action=delete&id=<?php echo $contact->getId(); ?>">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>

    </table>
    <?php else: ?>
    <p>Aucun contact disponible.</p>
    <?php endif; ?>

</body>

</html>