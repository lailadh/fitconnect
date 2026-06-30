<?php
session_start();

require_once '../../app/Controllers/AdherentController.php';

$controller = new AdherentController();
$adherents = $controller->index();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Adhérents</title>
    <link rel="stylesheet" href="../../public/css/style.css">
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .success { color: green; }
    </style>
</head>
<body>

<h1>Liste des Adhérents</h1>

<?php if (isset($_SESSION['success'])): ?>
    <p class="success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></p>
<?php endif; ?>

<a href="create.php" class="link-btn">+ Ajouter un adhérent</a>
<a href="../dashboard/index.php" class="link-btn">← Retour</a>
<br><br>

<table>
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Email</th>
        <th>Téléphone</th>
    </tr>

    <?php foreach ($adherents as $adherent): ?>
    <tr>
        <td><?= htmlspecialchars($adherent->getIdAdherent()); ?></td>
        <td><?= htmlspecialchars($adherent->getNom()); ?></td>
        <td><?= htmlspecialchars($adherent->getPrenom()); ?></td>
        <td><?= htmlspecialchars($adherent->getEmail()); ?></td>
        <td><?= htmlspecialchars($adherent->getTelephone()); ?></td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>