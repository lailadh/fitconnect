<?php

require_once __DIR__ . '/../Services/SeanceService.php';

class SeanceController
{
    private $seanceService;

    public function __construct()
    {
        $this->seanceService = new SeanceService();
    }

    public function index()
    {
        return $this->seanceService->getAllSeances();
    }

    public function store($data)
    {
        $result = $this->seanceService->createSeance($data);
        
        if (!$result['success']) {
            $_SESSION['errors'] = $result['errors'];
            $_SESSION['old'] = $data;
        }
        
        return $result;
    }
}