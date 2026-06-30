<?php

require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../Entities/Abonnement.php';

class AbonnementRepository
{
    private $pdo;

    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->connect();
    }

    public function getLastId()
    {
        $sql = "SELECT id_abonnement FROM ABONNEMENT ORDER BY id_abonnement DESC LIMIT 1";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchColumn() ?: null;
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM ABONNEMENT WHERE id_abonnement = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$data) return null;
        
        return $this->hydrate($data);
    }

    public function findByAdherent($id_adherent)
    {
        $sql = "SELECT * FROM ABONNEMENT WHERE id_adherent = ? AND statut = 'Actif' ORDER BY date_debut DESC LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_adherent]);
        
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$data) return null;
        
        return $this->hydrate($data);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM ABONNEMENT";
        $stmt = $this->pdo->query($sql);
        
        $abonnements = [];
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $abonnements[] = $this->hydrate($data);
        }
        
        return $abonnements;
    }

    public function create(Abonnement $abonnement)
    {
        $sql = "INSERT INTO ABONNEMENT (id_abonnement, type_abonnement, date_debut, date_fin, statut, id_adherent)
                VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->pdo->prepare($sql);
        
        return $stmt->execute([
            $abonnement->getIdAbonnement(),
            $abonnement->getTypeAbonnement(),
            $abonnement->getDateDebut(),
            $abonnement->getDateFin(),
            $abonnement->getStatut(),
            $abonnement->getIdAdherent()
        ]);
    }

    public function update(Abonnement $abonnement)
    {
        $sql = "UPDATE ABONNEMENT 
                SET type_abonnement = ?, date_debut = ?, date_fin = ?, statut = ?, id_adherent = ?
                WHERE id_abonnement = ?";
        
        $stmt = $this->pdo->prepare($sql);
        
        return $stmt->execute([
            $abonnement->getTypeAbonnement(),
            $abonnement->getDateDebut(),
            $abonnement->getDateFin(),
            $abonnement->getStatut(),
            $abonnement->getIdAdherent(),
            $abonnement->getIdAbonnement()
        ]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM ABONNEMENT WHERE id_abonnement = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }

    private function hydrate($data)
    {
        $abonnement = new Abonnement(
            $data['type_abonnement'],
            $data['date_debut'],
            $data['date_fin'],
            $data['statut'],
            $data['id_adherent']
        );
        $abonnement->setIdAbonnement($data['id_abonnement']);
        
        return $abonnement;
    }
}