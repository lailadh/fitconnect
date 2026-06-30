<?php

class Adherent
{
    private $id_adherent;
    private $nom;
    private $prenom;
    private $email;
    private $telephone;
    private $date_inscription;
    private $id_salle;

    public function __construct($nom, $prenom, $email, $telephone, $date_inscription, $id_salle)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->telephone = $telephone;
        $this->date_inscription = $date_inscription;
        $this->id_salle = $id_salle;
    }

    public function getIdAdherent() { return $this->id_adherent; }
    public function getNom() { return $this->nom; }
    public function getPrenom() { return $this->prenom; }
    public function getEmail() { return $this->email; }
    public function getTelephone() { return $this->telephone; }
    public function getDateInscription() { return $this->date_inscription; }
    public function getIdSalle() { return $this->id_salle; }

    public function setIdAdherent($id) { $this->id_adherent = $id; }
    public function setNom($nom) { $this->nom = $nom; }
    public function setPrenom($prenom) { $this->prenom = $prenom; }
    public function setEmail($email) { $this->email = $email; }
    public function setTelephone($telephone) { $this->telephone = $telephone; }
    public function setDateInscription($date) { $this->date_inscription = $date; }
    public function setIdSalle($id_salle) { $this->id_salle = $id_salle; }
}