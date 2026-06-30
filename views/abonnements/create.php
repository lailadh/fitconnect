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
    <title>Ajouter un Abonnement</title>
    <link rel="stylesheet" href="../../public/css/style.css">
</head>
<body>

<div class="container">
    <div class="card">
        <h1>💳 Nouvel Abonnement</h1>
        
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
            <form action="../../public/index.php?action=storeAbonnement" method="POST">
                
                <div class="form-group">
                    <label>Type *</label>
                    <select name="type_abonnement" required>
                        <option value="">-- Choisir --</option>
                        <option value="Mensuel" <?= ($old['type_abonnement'] ?? '') === 'Mensuel' ? 'selected' : '' ?>>Mensuel</option>
                        <option value="Trimestriel" <?= ($old['type_abonnement'] ?? '') === 'Trimestriel' ? 'selected' : '' ?>>Trimestriel</option>
                        <option value="Annuel" <?= ($old['type_abonnement'] ?? '') === 'Annuel' ? 'selected' : '' ?>>Annuel</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Date début *</label>
                    <input type="date" name="date_debut" value="<?= htmlspecialchars($old['date_debut'] ?? '') ?>" required>
                </div>

                <div class="form-group">
                    <label>Date fin *</label>
                    <input type="date" name="date_fin" value="<?= htmlspecialchars($old['date_fin'] ?? '') ?>" required>
                </div>

                <div class="form-group">
                    <label>Statut *</label>
                    <select name="statut" required>
                        <option value="Actif" <?= ($old['statut'] ?? 'Actif') === 'Actif' ? 'selected' : '' ?>>Actif</option>
                        <option value="Inactif" <?= ($old['statut'] ?? '') === 'Inactif' ? 'selected' : '' ?>>Inactif</option>
                        <option value="Expire" <?= ($old['statut'] ?? '') === 'Expire' ? 'selected' : '' ?>>Expiré</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>ID Adhérent *</label>
                    <input type="text" name="id_adherent" value="<?= htmlspecialchars($old['id_adherent'] ?? '') ?>" placeholder="A001" required>
                </div>

                <button type="submit" class="btn btn-success">✓ Ajouter</button>

            </form>
        </div>

        <a href="index.php" class="retour-link">← Retour à la liste</a>

    </div>
</div>

</body>
</html>