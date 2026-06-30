<?php

require_once __DIR__ . '/../Repositories/AbonnementRepository.php';

class AbonnementService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new AbonnementRepository();
    }

    public function getAllAbonnements()
    {
        return $this->repository->getAll();
    }

    public function getAbonnementById($id)
    {
        return $this->repository->findById($id);
    }

    public function getAbonnementByAdherent($id_adherent)
    {
        return $this->repository->findByAdherent($id_adherent);
    }

    public function createAbonnement($data)
    {
        $errors = $this->validate($data);
        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors];
        }

        if ($data['date_fin'] <= $data['date_debut']) {
            return ['success' => false, 'errors' => ['La date de fin doit être après la date de début']];
        }

        $id = $this->generateId();

        $abonnement = new Abonnement(
            $data['type_abonnement'],
            $data['date_debut'],
            $data['date_fin'],
            $data['statut'],
            $data['id_adherent']
        );
        $abonnement->setIdAbonnement($id);

        $success = $this->repository->create($abonnement);
        
        return [
            'success' => $success,
            'message' => $success ? 'Abonnement créé avec succès' : 'Erreur lors de la création',
            'id' => $id
        ];
    }

    private function generateId()
    {
        $lastId = $this->repository->getLastId();
        
        if ($lastId) {
            $number = intval(substr($lastId, 2)) + 1;
        } else {
            $number = 1;
        }
        
        return 'AB' . str_pad($number, 3, '0', STR_PAD_LEFT);
    }

    private function validate($data)
    {
        $errors = [];
        
        if (empty($data['type_abonnement']) || !in_array($data['type_abonnement'], ['Mensuel', 'Trimestriel', 'Annuel'])) {
            $errors[] = "Type d'abonnement invalide";
        }
        
        if (empty($data['date_debut'])) {
            $errors[] = "Date de début requise";
        }
        
        if (empty($data['date_fin'])) {
            $errors[] = "Date de fin requise";
        }
        
        if (empty($data['statut']) || !in_array($data['statut'], ['Actif', 'Inactif', 'Expire'])) {
            $errors[] = "Statut invalide";
        }
        
        if (empty($data['id_adherent'])) {
            $errors[] = "Adhérent requis";
        }
        
        return $errors;
    }
}