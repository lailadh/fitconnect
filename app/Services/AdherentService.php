<?php

require_once __DIR__ . '/../Repositories/AdherentRepository.php';

class AdherentService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new AdherentRepository();
    }

    public function getAllAdherents()
    {
        return $this->repository->getAll();
    }

    public function getAdherentById($id)
    {
        return $this->repository->findById($id);
    }

    public function createAdherent($data)
    {
        $errors = $this->validate($data);
        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors];
        }

        if ($this->repository->findByEmail($data['email'])) {
            return ['success' => false, 'errors' => ['Cet email est déjà utilisé']];
        }

        $id = $this->generateId();
        
        $adherent = new Adherent(
            $data['nom'],
            $data['prenom'],
            $data['email'],
            $data['telephone'],
            $data['date_inscription'],
            $data['id_salle']
        );
        $adherent->setIdAdherent($id);

        $success = $this->repository->create($adherent);
        
        return [
            'success' => $success,
            'message' => $success ? 'Adhérent créé avec succès' : 'Erreur lors de la création',
            'id' => $id
        ];
    }

    private function generateId()
    {
        $lastId = $this->repository->getLastId();
        
        if ($lastId) {
            $number = intval(substr($lastId, 1)) + 1;
        } else {
            $number = 1;
        }
        
        return 'A' . str_pad($number, 3, '0', STR_PAD_LEFT);
    }

    private function validate($data)
    {
        $errors = [];
        
        if (empty($data['nom']) || strlen($data['nom']) < 2) {
            $errors[] = "Le nom doit contenir au moins 2 caractères";
        }
        
        if (empty($data['prenom']) || strlen($data['prenom']) < 2) {
            $errors[] = "Le prénom doit contenir au moins 2 caractères";
        }
        
        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Email invalide";
        }
        
        if (empty($data['telephone']) || !preg_match('/^0[0-9]{9}$/', $data['telephone'])) {
            $errors[] = "Téléphone invalide (format: 0612345678)";
        }
        
        if (empty($data['date_inscription'])) {
            $errors[] = "Date d'inscription requise";
        }
        
        if (empty($data['id_salle'])) {
            $errors[] = "Salle requise";
        }
        
        return $errors;
    }
}