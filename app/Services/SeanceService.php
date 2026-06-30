<?php

require_once __DIR__ . '/../Repositories/SeanceRepository.php';
require_once __DIR__ . '/../Repositories/AbonnementRepository.php';

class SeanceService
{
    private $seanceRepository;
    private $abonnementRepository;

    public function __construct()
    {
        $this->seanceRepository = new SeanceRepository();
        $this->abonnementRepository = new AbonnementRepository();
    }

    public function getAllSeances()
    {
        return $this->seanceRepository->getAll();
    }

    public function getSeanceById($id)
    {
        return $this->seanceRepository->findById($id);
    }

    public function getSeancesByAdherent($id_adherent)
    {
        return $this->seanceRepository->findByAdherent($id_adherent);
    }

    public function createSeance($data)
    {
        $errors = $this->validate($data);
        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors];
        }

        $abonnement = $this->abonnementRepository->findByAdherent($data['id_adherent']);
        
        if (!$abonnement) {
            return ['success' => false, 'errors' => ['Cet adhérent n\'a pas d\'abonnement actif']];
        }
        
        if ($abonnement->getDateFin() < date('Y-m-d')) {
            return ['success' => false, 'errors' => ['L\'abonnement de cet adhérent est expiré']];
        }

        $id = $this->generateId();

        $seance = new Seance(
            $data['date_seance'],
            $data['duree'],
            $data['type_activite'],
            $data['equipement_utilise'] ?? null,
            $data['id_adherent'],
            $data['id_salle']
        );
        $seance->setIdSeance($id);

        $success = $this->seanceRepository->create($seance);
        
        return [
            'success' => $success,
            'message' => $success ? 'Séance enregistrée avec succès' : 'Erreur lors de l\'enregistrement',
            'id' => $id
        ];
    }

    private function generateId()
    {
        $lastId = $this->seanceRepository->getLastId();
        
        if ($lastId) {
            $number = intval(substr($lastId, 2)) + 1;
        } else {
            $number = 1;
        }
        
        return 'SE' . str_pad($number, 3, '0', STR_PAD_LEFT);
    }

    private function validate($data)
    {
        $errors = [];
        
        if (empty($data['date_seance'])) {
            $errors[] = "Date de la séance requise";
        }
        
        if (empty($data['duree'])) {
            $errors[] = "Durée requise";
        }
        
        if (empty($data['type_activite'])) {
            $errors[] = "Type d'activité requis";
        }
        
        if (empty($data['id_adherent'])) {
            $errors[] = "Adhérent requis";
        }
        
        if (empty($data['id_salle'])) {
            $errors[] = "Salle requise";
        }
        
        return $errors;
    }
}