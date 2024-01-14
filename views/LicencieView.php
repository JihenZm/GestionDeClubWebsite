<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Gestion des Licenciés</title>
</head>

<body>
    <h1>Gestion des Licenciés</h1>
    <a href="index.php?page=home">Retour à l'acceuil</a>

    <!-- Bouton pour créer une catégorie -->
    <a href="index.php?page=licencie&action=add">Créer un nouveau licencié</a>

    <h2>Liste des licenciés</h2>
    <?php if (!empty($licencies)): ?>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Numéro de licence</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Catégorie</th>
            <th>Email</th>
            <th>Numéro de téléphone</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($licencies as $licencie): ?>
        <tr>
            <td><?php echo $licencie->getId(); ?></td>
            <td><?php echo $licencie->getNumeroLicence(); ?></td>
            <td><?php echo $licencie->getNom(); ?></td>
            <td><?php echo $licencie->getPrenom(); ?></td>
            <td>
                <?php
    $categorie = $licencie->getCategorie();
    echo ($categorie !== null) ? $categorie->getNom() : 'N/A';
    ?>
            </td>
            <?php
        $contact = $licencie->getContact();
        if ($contact !== null) {
            echo '<td>' . $contact->getEmail() . '</td>';
            echo '<td>' . $contact->getNumeroTel() . '</td>';
        } else {
            echo '<td>N/A</td>';
            echo '<td>N/A</td>';
        }
        ?>
            <td>
                <a href="index.php?page=licencie&action=edit&id=<?php echo $licencie->getId(); ?>">Modifier</a>
                <a href="index.php?page=licencie&action=delete&id=<?php echo $licencie->getId(); ?>">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>

    </table>
    <?php else: ?>
    <p>Aucun licencié disponible.</p>
    <?php endif; ?>

</body>

</html>