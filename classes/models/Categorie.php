<?php

class Categorie {
    private $id;
    private $nom;
    private $codeRaccourci;

    public function __construct($id = null, $nom = null, $codeRaccourci = null) {
        $this->id = $id;
        $this->nom = $nom;
        $this->codeRaccourci = $codeRaccourci;
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

    // Getter and Setter for codeRaccourci
    public function getCodeRaccourci() {
        return $this->codeRaccourci;
    }

    // Setter for codeRaccourci
    public function setCodeRaccourci($codeRaccourci) {
        $this->codeRaccourci = $codeRaccourci;
    }

}

?>