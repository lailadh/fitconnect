<?php

require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../Entities/Seance.php';

class SeanceRepository
{
    private $pdo;

    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->connect();
    }

    public function getLastId()
    {
        $sql = "SELECT id_seance FROM SEANCE ORDER BY id_seance DESC LIMIT 1";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchColumn() ?: null;
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM SEANCE WHERE id_seance = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$data) return null;
        
        return $this->hydrate($data);
    }

    public function findByAdherent($id_adherent)
    {
        $sql = "SELECT * FROM SEANCE WHERE id_adherent = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_adherent]);
        
        $seances = [];
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $seances[] = $this->hydrate($data);
        }
        
        return $seances;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM SEANCE";
        $stmt = $this->pdo->query($sql);
        
        $seances = [];
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $seances[] = $this->hydrate($data);
        }
        
        return $seances;
    }

    public function create(Seance $seance)
    {
        $sql = "INSERT INTO SEANCE (id_seance, date_seance, duree, type_activite, equipement_utilise, id_adherent, id_salle)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->pdo->prepare($sql);
        
        return $stmt->execute([
            $seance->getIdSeance(),
            $seance->getDateSeance(),
            $seance->getDuree(),
            $seance->getTypeActivite(),
            $seance->getEquipementUtilise(),
            $seance->getIdAdherent(),
            $seance->getIdSalle()
        ]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM SEANCE WHERE id_seance = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }

    private function hydrate($data)
    {
        $seance = new Seance(
            $data['date_seance'],
            $data['duree'],
            $data['type_activite'],
            $data['equipement_utilise'],
            $data['id_adherent'],
            $data['id_salle']
        );
        $seance->setIdSeance($data['id_seance']);
        
        return $seance;
    }
}