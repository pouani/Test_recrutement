<?php
    class Client{

        // propriete du client
        public $id;
        public $Nom;
        public $Prenom;
        public $Date_de_naissance;
        public $Sexe;
        public $status;

        // connexion a la bd
        private $connexion;
        private $table = "clients";

        public function __construct($db){
            $this->connexion = $db;
        }
    
        /**
         * Lecture des clients
         *
         * @return void
         */
        public function lire(){
            // On écrit la requête
            $sql = "SELECT * FROM clients";
    
            // On prépare la requête
            $query = $this->connexion->prepare($sql);
    
            // On exécute la requête
            $query->execute();
    
            // On retourne le résultat
            return $query;
        }
    
        /**
         * Créer un client
         *
         * @return void
         */
        public function creer(){
    
            // Ecriture de la requête SQL en y insérant le nom de la table
            $sql = "INSERT INTO " . $this->table . " VALUES(null,:nom,:prenom,:date_naisance,:sexe,1)";
    
            // Préparation de la requête
            $query = $this->connexion->prepare($sql);
    
            // Protection contre les injections
            $this->nom=htmlspecialchars(strip_tags($this->nom));
            $this->prenom=htmlspecialchars(strip_tags($this->prenom));
            $this->date_naisance=htmlspecialchars(strip_tags($this->date_naisance));
            $this->sexe=htmlspecialchars(strip_tags($this->sexe));
           
    
            // Ajout des données protégées
            $query->bindParam(":nom", $this->nom);
            $query->bindParam(":prenom", $this->prenom);
            $query->bindParam(":date_naisance", $this->date_naisance);
            $query->bindParam(":sexe", $this->sexe);
            // Exécution de la requête
            if($query->execute()){
                return true;
            }
            return false;
        }
    
        /**
         * Lire un client
         *
         * @return void
         */
        public function lireUn(){
            // On écrit la requête
            $sql = "SELECT c.* FROM clients c WHERE c.id = ? LIMIT 0,1";
    
            // On prépare la requête
            $query = $this->connexion->prepare( $sql );
    
            // On attache l'id
            $query->bindParam(1, $this->id);
    
            // On exécute la requête
            $query->execute();
    
            // on récupère la ligne
            $row = $query->fetch(PDO::FETCH_ASSOC);
    
            // On hydrate l'objet
            $this->id = $row['id'];
            $this->nom = $row['nom'];
            $this->prix = $row['prenom'];
            $this->description = $row['date_naisance'];
            $this->categories_id = $row['sexe'];
            $this->status = $row['status'];
           
        }
    
        /**
         * Supprimer un client
         *
         * @return void
         */
        public function supprimer(){
            // On écrit la requête
            $sql = "DELETE FROM " . $this->table . " WHERE id = ?";
    
            // On prépare la requête
            $query = $this->connexion->prepare( $sql );
    
            // On sécurise les données
            $this->id=htmlspecialchars(strip_tags($this->id));
    
            // On attache l'id
            $query->bindParam(1, $this->id);
    
            // On exécute la requête
            if($query->execute()){
                return true;
            }
            
            return false;
        }
    
        /**
         * Mettre à jour un client
         *
         * @return void
         */
        public function modifier(){
            // On écrit la requête
            $sql = "UPDATE " . $this->table . " SET nom = :nom, prenom = :prenom, date_naisance = :date_naisance, sexe = :sexe WHERE id = :id";
            json_encode($sql);
            // On prépare la requête
            $query = $this->connexion->prepare($sql);
            
            // Protection contre les injections
            $this->nom=htmlspecialchars(strip_tags($this->nom));
            $this->prenom=htmlspecialchars(strip_tags($this->prenom));
            $this->date_naisance=htmlspecialchars(strip_tags($this->date_naisance));
            $this->sexe=htmlspecialchars(strip_tags($this->sexe));
            $this->id=htmlspecialchars(strip_tags($this->id));
    
            // Ajout des données protégées
            $query->bindParam(":nom", $this->nom);
            $query->bindParam(":prenom", $this->prenom);
            $query->bindParam(":date_naisance", $this->date_naisance);
            $query->bindParam(":sexe", $this->sexe);
            $query->bindParam(':id', $this->id);
            // On exécute
            if($query->execute()){
                return true;
            }
            
            return false;
        }
        public function status(){
            // On écrit la requête
            $sql = "UPDATE " . $this->table . " SET status = :status WHERE id = :id";
            json_encode($sql);
            // On prépare la requête
            $query = $this->connexion->prepare($sql);
            
            // Protection contre les injections
          
            $this->id=htmlspecialchars(strip_tags($this->id));
            $this->status=htmlspecialchars(strip_tags($this->status));
    
            // Ajout des données protégées
            $query->bindParam(":status", $this->status);
            $query->bindParam(':id', $this->id);
            // On exécute
            if($query->execute()){
                return true;
            }
            
            return false;
        }
    
    }
?>