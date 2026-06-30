<?php

require_once __DIR__ . '/../Services/AdherentService.php';

class AdherentController
{
    private $adherentService;

    public function __construct()
    {
        $this->adherentService = new AdherentService();
    }

    public function index()
    {
        return $this->adherentService->getAllAdherents();
    }

    public function show($id)
    {
        return $this->adherentService->getAdherentById($id);
    }

    public function store($data)
    {
        $result = $this->adherentService->createAdherent($data);
        
        if (!$result['success']) {
            $_SESSION['errors'] = $result['errors'];
            $_SESSION['old'] = $data;
        }
        
        return $result;
    }
}