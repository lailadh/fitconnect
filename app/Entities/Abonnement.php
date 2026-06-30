<?php

class Abonnement
{
    private $id_abonnement;
    private $type_abonnement;
    private $date_debut;
    private $date_fin;
    private $statut;
    private $id_adherent;

    public function __construct($type_abonnement, $date_debut, $date_fin, $statut, $id_adherent)
    {
        $this->type_abonnement = $type_abonnement;
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
        $this->statut = $statut;
        $this->id_adherent = $id_adherent;
    }

    public function getIdAbonnement() { return $this->id_abonnement; }
    public function getTypeAbonnement() { return $this->type_abonnement; }
    public function getDateDebut() { return $this->date_debut; }
    public function getDateFin() { return $this->date_fin; }
    public function getStatut() { return $this->statut; }
    public function getIdAdherent() { return $this->id_adherent; }

    public function setIdAbonnement($id) { $this->id_abonnement = $id; }
    public function setTypeAbonnement($type) { $this->type_abonnement = $type; }
    public function setDateDebut($date) { $this->date_debut = $date; }
    public function setDateFin($date) { $this->date_fin = $date; }
    public function setStatut($statut) { $this->statut = $statut; }
    public function setIdAdherent($id) { $this->id_adherent = $id; }
}