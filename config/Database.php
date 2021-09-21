<?php
class Database{
    // Connexion à la base de données
    private $host = "localhost";
    private $db_name = "client_bd";
    private $username = "root";
    private $password = "";
    public $connexion;

    // getter pour la connexion
    public function getConnection(){

        $this->connexion = null;

        $this->connexion = new PDO
        (
            "mysql:host=" . $this->host . ";dbname=" . $this->db_name.";charset=utf8", 
            $this->username,
            $this->password,
            array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
        );
        return $this->connexion;
    }   
}