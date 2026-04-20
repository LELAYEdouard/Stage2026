<?php
    class Database {
    // Informations de connexion à la base de données
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $conn;

    public function __construct() {
        $this->host = getenv('DB_HOST');
        $this->db_name = getenv('DB_NAME');
        $this->username = getenv('DB_USER');
        $this->password = getenv('DB_PASSWORD');
    }
    // Méthode pour établir la connexion à la base de données
    public function getConnection() {
        $this->conn = null;
        try {
            // Création d'une nouvelle instance PDO pour se
            // connecter à la base de données
            $this->conn = new PDO("mysql:host=" . $this->host .
            ";dbname=" . $this->db_name . ";charset=utf8mb4", $this->username,
            $this->password);
            // Définir le mode d'erreur sur Exception pour une
            // meilleure gestion des erreurs
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            // Gestion des erreurs de connexion
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
    }
?>