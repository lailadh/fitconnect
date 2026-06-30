<?php

session_start();

require_once '../app/Controllers/AdherentController.php';
require_once '../app/Controllers/AbonnementController.php';
require_once '../app/Controllers/SeanceController.php';

$action = $_GET['action'] ?? 'home';

switch ($action) {
    case 'storeAdherent':
        handleStoreAdherent();
        break;
        
    case 'storeAbonnement':
        handleStoreAbonnement();
        break;
        
    case 'storeSeance':
        handleStoreSeance();
        break;
        
    default:
        header('Location: views/dashboard/index.php');
        exit;
}

function handleStoreAdherent()
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: views/adherents/create.php');
        exit;
    }

    $controller = new AdherentController();
    $result = $controller->store($_POST);

    if ($result['success']) {
        $_SESSION['success'] = $result['message'];
        header('Location: views/adherents/index.php');
    } else {
        $_SESSION['errors'] = $result['errors'];
        $_SESSION['old'] = $_POST;
        header('Location: views/adherents/create.php');
    }
    exit;
}

function handleStoreAbonnement()
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: views/abonnements/create.php');
        exit;
    }

    $controller = new AbonnementController();
    $result = $controller->store($_POST);

    if ($result['success']) {
        $_SESSION['success'] = $result['message'];
        header('Location: views/abonnements/index.php');
    } else {
        $_SESSION['errors'] = $result['errors'];
        $_SESSION['old'] = $_POST;
        header('Location: views/abonnements/create.php');
    }
    exit;
}

function handleStoreSeance()
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: views/seances/create.php');
        exit;
    }

    $controller = new SeanceController();
    $result = $controller->store($_POST);

    if ($result['success']) {
        $_SESSION['success'] = $result['message'];
        header('Location: views/seances/index.php');
    } else {
        $_SESSION['errors'] = $result['errors'];
        $_SESSION['old'] = $_POST;
        header('Location: views/seances/create.php');
    }
    exit;
}