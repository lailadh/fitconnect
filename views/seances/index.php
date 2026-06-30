<?php
session_start();

require_once '../../app/Controllers/SeanceController.php';

$controller = new SeanceController();
$seances = $controller->index();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Séances</title>
     <link rel="stylesheet" href="../../public/css/style.css">
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .success { color: green; }
    </style>
</head>
<body>

<h1>Liste des Séances</h1>

<?php if (isset($_SESSION['success'])): ?>
    <p class="success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></p>
<?php endif; ?>

<a href="create.php" class="link-btn">+ Ajouter un adhérent</a>
<a href="../dashboard/index.php" class="link-btn">← Retour</a>
<br><br>

<table>
    <tr>
        <th>ID</th>
        <th>Date</th>
        <th>Durée</th>
        <th>Activité</th>
        <th>Équipement</th>
        <th>Adhérent</th>
        <th>Salle</th>
    </tr>

    <?php foreach ($seances as $seance): ?>
    <tr>
        <td><?= htmlspecialchars($seance->getIdSeance()); ?></td>
        <td><?= htmlspecialchars($seance->getDateSeance()); ?></td>
        <td><?= htmlspecialchars($seance->getDuree()); ?></td>
        <td><?= htmlspecialchars($seance->getTypeActivite()); ?></td>
        <td><?= htmlspecialchars($seance->getEquipementUtilise() ?? 'Aucun'); ?></td>
        <td><?= htmlspecialchars($seance->getIdAdherent()); ?></td>
        <td><?= htmlspecialchars($seance->getIdSalle()); ?></td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>