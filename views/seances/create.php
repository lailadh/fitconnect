<?php
session_start();
$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];
unset($_SESSION['errors'], $_SESSION['old']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une Séance</title>
    <link rel="stylesheet" href="../../public/css/style.css">
</head>
<body>

<div class="container">
    <div class="card">
        <h1>🏋️ Nouvelle Séance</h1>
        
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="form-container">
            <form action="../../public/index.php?action=storeSeance" method="POST">
                
                <div class="form-group">
                    <label>Date séance *</label>
                    <input type="date" name="date_seance" value="<?= htmlspecialchars($old['date_seance'] ?? date('Y-m-d')) ?>" required>
                </div>

                <div class="form-group">
                    <label>Durée *</label>
                    <input type="time" name="duree" value="<?= htmlspecialchars($old['duree'] ?? '01:00') ?>" required>
                </div>

                <div class="form-group">
                    <label>Type d'activité *</label>
                    <input type="text" name="type_activite" value="<?= htmlspecialchars($old['type_activite'] ?? '') ?>" placeholder="Musculation, Cardio..." required>
                </div>

                <div class="form-group">
                    <label>Équipement utilisé</label>
                    <input type="text" name="equipement_utilise" value="<?= htmlspecialchars($old['equipement_utilise'] ?? '') ?>" placeholder="Tapis, Haltères...">
                </div>

                <div class="form-group">
                    <label>ID Adhérent *</label>
                    <input type="text" name="id_adherent" value="<?= htmlspecialchars($old['id_adherent'] ?? '') ?>" placeholder="A001" required>
                </div>

                <div class="form-group">
                    <label>Salle *</label>
                    <select name="id_salle" required>
                        <option value="">-- Choisir --</option>
                        <option value="S001" <?= ($old['id_salle'] ?? '') === 'S001' ? 'selected' : '' ?>>S001 - Casa</option>
                        <option value="S002" <?= ($old['id_salle'] ?? '') === 'S002' ? 'selected' : '' ?>>S002 - Rabat</option>
                        <option value="S003" <?= ($old['id_salle'] ?? '') === 'S003' ? 'selected' : '' ?>>S003 - Marrakech</option>
                        <option value="S004" <?= ($old['id_salle'] ?? '') === 'S004' ? 'selected' : '' ?>>S004 - Tanger</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">✓ Ajouter</button>

            </form>
        </div>

        <a href="index.php" class="retour-link">← Retour à la liste</a>

    </div>
</div>

</body>
</html>