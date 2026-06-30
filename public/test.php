<?php

require_once __DIR__ . '/../app/Controllers/AdherentController.php';

$controller = new AdherentController();

$resultat = $controller->index();

echo "<h1>🧪 Tests FitConnect</h1><hr>";

echo "<h2>Test: Liste des adhérents</h2>";
echo "Nombre d'adhérents: " . count($resultat) . "<br><br>";

foreach ($resultat as $adherent) {
    echo "- " . $adherent->getIdAdherent() . ": ";
    echo $adherent->getNom() . " " . $adherent->getPrenom();
    echo " (" . $adherent->getEmail() . ")<br>";
}

echo "<hr><p>✅ Test terminé</p>";