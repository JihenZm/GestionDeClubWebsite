<?php

class Licencie {

private $id;
private $numeroLicence;
private $nom;
private $prenom;
private $categorie;
private $contact;

public function __construct($id = null, $numeroLicence = null, $nom = null, $prenom = null, Categorie $categorie = null, Contact $contact = null) {
    $this->id = $id;
    $this->numeroLicence = $numeroLicence;
    $this->nom = $nom;
    $this->prenom = $prenom;
    $this->categorie = $categorie;
    $this->contact = $contact;
}

// Getter and Setter for id
public function getId() {
    return $this->id;
}

public function setId($id) {
    $this->id = $id;
}

// Getter and Setter for numeroLicence
public function getNumeroLicence() {
    return $this->numeroLicence;
}

public function setNumeroLicence($numeroLicence) {
    $this->numeroLicence = $numeroLicence;
}

// Getter and Setter for nom
public function getNom() {
    return $this->nom;
}

public function setNom($nom) {
    $this->nom = $nom;
}

// Getter and Setter for prenom
public function getPrenom() {
    return $this->prenom;
}

public function setPrenom($prenom) {
    $this->prenom = $prenom;
}

// Getter and Setter for categorie
public function getCategorie() {
    return $this->categorie;
}

public function setCategorie(Categorie $categorie = null) {
    $this->categorie = $categorie;
}

// Getter and Setter for contact
public function getContact() {
    return $this->contact;
}

public function setContact(Contact $contact = null) {
    $this->contact = $contact;
}
}
?>