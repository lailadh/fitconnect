<?php
session_start();

require_once '../../app/Controllers/AdherentController.php';
require_once '../../app/Controllers/AbonnementController.php';

$adherentController = new AdherentController();
$abonnementController = new AbonnementController();

$adherents = $adherentController->index();
$abonnements = $abonnementController->index();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard FitConnect</title>
    <link rel="stylesheet" href="../../public/css/style.css">
</head>
<body>

<div class="container">
    <div class="card">  <!-- ← زيد class="card" -->
        <h1>🏋️ FitConnect</h1>
        
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number"><?= count($adherents); ?></div>
                <div class="stat-label">Adhérents</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?= count($abonnements); ?></div>
                <div class="stat-label">Abonnements</div>
            </div>
        </div>

        <div class="nav-menu">
            <a href="../adherents/index.php">👥 Gestion des adhérents</a>
            <a href="../abonnements/index.php">💳 Gestion des abonnements</a>
            <a href="../seances/index.php">🏋️ Gestion des séances</a>
        </div>
    </div>
</div>

</body>
</html>