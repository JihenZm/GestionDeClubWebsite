<?php
class Connexion {
    private $pdo;
    
    public function __construct($dbHost, $dbName, $dbUser, $dbPassword) {
        try {
            $this->pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erreur de connexion à la base de données: " . $e->getMessage();
            exit();
        }
    }

    public function getPDO() {
        return $this->pdo;
    }
}
?>