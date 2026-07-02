<?php

class Salle
{
    private $id_salle;
    private $nom_salle;
    private $adresse;
    private $ville;

    public function __construct($id_salle, $nom_salle, $adresse, $ville)
    {
        $this->id_salle = $id_salle;
        $this->nom_salle = $nom_salle;
        $this->adresse = $adresse;
        $this->ville = $ville;
    }
gggggggggggggggggggg
    public function getIdSalle() { return $this->id_salle; }
    public function getNomSalle() { return $this->nom_salle; }
    public function getAdresse() { return $this->adresse; }
    public function getVille() { return $this->ville; }

    public function setIdSalle($id) { $this->id_salle = $id; }
    public function setNomSalle($nom) { $this->nom_salle = $nom; }
    public function setAdresse($adresse) { $this->adresse = $adresse; }
    public function setVille($ville) { $this->ville = $ville; }
}