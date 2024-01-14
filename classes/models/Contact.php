<?php

class Contact {
    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $numerotel;

    public function __construct($nom = null, $prenom = null, $email = null, $numerotel = null) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->numerotel = $numerotel;
    }

    // Getter and Setter for id
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
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

    // Getter and Setter for email
    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    // Getter and Setter for numerotel
    public function getNumerotel() {
        return $this->numerotel;
    }

    public function setNumerotel($numerotel) {
        $this->numerotel = $numerotel;
    }

}

?>