<?php

require_once __DIR__ . '/../Services/AbonnementService.php';

class AbonnementController
{
    private $abonnementService;

    public function __construct()
    {
        $this->abonnementService = new AbonnementService();
    }

    public function index()
    {
        return $this->abonnementService->getAllAbonnements();
    }

    public function store($data)
    {
        $result = $this->abonnementService->createAbonnement($data);
        
        if (!$result['success']) {
            $_SESSION['errors'] = $result['errors'];
            $_SESSION['old'] = $data;
        }
        
        return $result;
    }
}