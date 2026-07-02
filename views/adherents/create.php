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
    <title>Ajouter un Adhérent</title>
    <link rel="stylesheet" href="../../public/css/style.css">
</head>
<body>

<div class="container">
    <div class="card">
        <h1>👤 Nouvel Adhérent</h1>
        
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- ← form-container هنا! -->
        <div class="form-container">
            <form action="../../public/index.php?action=storeAdherent" method="POST">
                
                <div class="form-group">
                    <label>Nom *</label>
                    <input type="text" name="nom" value="<?= htmlspecialchars($old['nom'] ?? '') ?>" required>
                </div>

                <div class="form-group">
                    <label>Prénom *</label>
                    <input type="text" name="prenom" value="<?= htmlspecialchars($old['prenom'] ?? '') ?>" required>
                </div>

                <div class="form-group">
                    <label>Email *</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($old['email'] ?? '') ?>" required>
                </div>

                <div class="form-group">
                    <label>Téléphone *</label>
                    <input type="text" name="telephone" value="<?= htmlspecialchars($old['telephone'] ?? '') ?>" placeholder="0612345678" required>
                </div>

                <div class="form-group">
                    <label>Date d'inscription *</label>
                    <input type="date" name="date_inscription" value="<?= htmlspecialchars($old['date_inscription'] ?? date('Y-m-d')) ?>" required>
                </div>

                <div class="form-group">
                    <label>Salle *</label>
                    <select name="id_salle" required>
                        <option value="">-- Choisir --</option>
                        <option value="S001" <?= ($old['id_salle'] ?? '') === 'S001' ? 'selected' : '' ?>>FitConnect Casa</option>
                        <option value="S002" <?= ($old['id_salle'] ?? '') === 'S002' ? 'selected' : '' ?>>FitConnect Rabat</option>
                        <option value="S003" <?= ($old['id_salle'] ?? '') === 'S003' ? 'selected' : '' ?>>FitConnect Marrakech</option>
                        <option value="S004" <?= ($old['id_salle'] ?? '') === 'S004' ? 'selected' : '' ?>>FitConnect Tanger</option>
                    </select>
                </div>

                <!-- ← button styled هنا! -->
                <button type="submit" class="btn btn-success">✓ Ajouter</button>

            </form>
        </div>

        <!-- ← retour styled هنا! -->
        <a href="index.php" class="retour-link">← Retour à la liste</a>

    </div>
</div>

</body>
</html>

