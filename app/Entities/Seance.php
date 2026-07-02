<?php

class Seance
{
    private $id_seance;
    private $date_seance;
    private $duree;
    private $type_activite;
    private $equipement_utilise;
    private $id_adherent;
    private $id_salle;

    public function __construct($date_seance, $duree, $type_activite, $equipement_utilise, $id_adherent, $id_salle)
    {
        $this->date_seance = $date_seance;
        $this->duree = $duree;
        $this->type_activite = $type_activite;
        $this->equipement_utilise = $equipement_utilise;
        $this->id_adherent = $id_adherent;
        $this->id_salle = $id_salle;
    }

    public function getIdSeance() { return $this->id_seance; }
    public function getDateSeance() { return $this->date_seance; }
    public function getDuree() { return $this->duree; }
    public function getTypeActivite() { return $this->type_activite; }
    public function getEquipementUtilise() { return $this->equipement_utilise; }
    public function getIdAdherent() { return $this->id_adherent; }
    public function getIdSalle() { return $this->id_salle; }

    public function setIdSeance($id) { $this->id_seance = $id; }
    public function setDateSeance($date) { $this->date_seance = $date; }
    public function setDuree($duree) { $this->duree = $duree; }
    public function setTypeActivite($type) { $this->type_activite = $type; }
    public function setEquipementUtilise($eq) { $this->equipement_utilise = $eq; }
    public function setIdAdherent($id) { $this->id_adherent = $id; }
    public function setIdSalle($id) { $this->id_salle = $id; }
}



