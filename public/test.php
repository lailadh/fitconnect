<?php

require_once '../config/Database.php';

$db = new Database();

$conn = $db->connect();

echo "Connexion réussie";