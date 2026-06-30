<?php
session_start();

require_once '../../app/Controllers/AbonnementController.php';

$controller = new AbonnementController();
$abonnements = $controller->index();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Abonnements</title>
    <link rel="stylesheet" href="../../public/css/style.css">
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .success { color: green; }
    </style>
</head>
<body>

<h1>Liste des Abonnements</h1>

<?php if (isset($_SESSION['success'])): ?>
    <p class="success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></p>
<?php endif; ?>

<a href="create.php" class="link-btn">+ Ajouter un adhérent</a>
<a href="../dashboard/index.php" class="link-btn">← Retour</a>
<br><br>

<table>
    <tr>
        <th>ID</th>
        <th>Type</th>
        <th>Date Début</th>
        <th>Date Fin</th>
        <th>Statut</th>
        <th>Adhérent</th>
    </tr>

    <?php foreach ($abonnements as $abonnement): ?>
    <tr>
        <td><?= htmlspecialchars($abonnement->getIdAbonnement()); ?></td>
        <td><?= htmlspecialchars($abonnement->getTypeAbonnement()); ?></td>
        <td><?= htmlspecialchars($abonnement->getDateDebut()); ?></td>
        <td><?= htmlspecialchars($abonnement->getDateFin()); ?></td>
        <td><?= htmlspecialchars($abonnement->getStatut()); ?></td>
        <td><?= htmlspecialchars($abonnement->getIdAdherent()); ?></td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>