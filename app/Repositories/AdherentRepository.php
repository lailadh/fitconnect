<?php

require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../Entities/Adherent.php';

class AdherentRepository
{
    private $pdo;

    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->connect();
    }

    public function getLastId()
    {
        $sql = "SELECT id_adherent FROM ADHERENT ORDER BY id_adherent DESC LIMIT 1";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchColumn() ?: null;
    }

    public function findByEmail($email)
    {
        $sql = "SELECT * FROM ADHERENT WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$data) return null;
        
        return $this->hydrate($data);
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM ADHERENT WHERE id_adherent = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$data) return null;
        
        return $this->hydrate($data);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM ADHERENT";
        $stmt = $this->pdo->query($sql);
        
        $adherents = [];
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $adherents[] = $this->hydrate($data);
        }
        
        return $adherents;
    }

    public function create(Adherent $adherent)
    {
        $sql = "INSERT INTO ADHERENT (id_adherent, nom, prenom, email, telephone, date_inscription, id_salle)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->pdo->prepare($sql);
        
        return $stmt->execute([
            $adherent->getIdAdherent(),
            $adherent->getNom(),
            $adherent->getPrenom(),
            $adherent->getEmail(),
            $adherent->getTelephone(),
            $adherent->getDateInscription(),
            $adherent->getIdSalle()
        ]);
    }

    public function update(Adherent $adherent)
    {
        $sql = "UPDATE ADHERENT 
                SET nom = ?, prenom = ?, email = ?, telephone = ?, date_inscription = ?, id_salle = ?
                WHERE id_adherent = ?";
        
        $stmt = $this->pdo->prepare($sql);
        
        return $stmt->execute([
            $adherent->getNom(),
            $adherent->getPrenom(),
            $adherent->getEmail(),
            $adherent->getTelephone(),
            $adherent->getDateInscription(),
            $adherent->getIdSalle(),
            $adherent->getIdAdherent()
        ]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM ADHERENT WHERE id_adherent = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }

    private function hydrate($data)
    {
        $adherent = new Adherent(
            $data['nom'],
            $data['prenom'],
            $data['email'],
            $data['telephone'],
            $data['date_inscription'],
            $data['id_salle']
        );
        $adherent->setIdAdherent($data['id_adherent']);
        
        return $adherent;
    }
}