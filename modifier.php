<?php 

// Headers requis
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

 // On inclut les fichiers de configuration et d'accès aux données
 require_once("config/Database.php");
 require_once("models/Client.php");
 
 // On instancie la base de données
 $database = new Database();
 $db = $database->getConnection();

 // On instancie les clients
 $client = new Client($db);

 if( !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['date_naisance']) && !empty($_POST['sexe'])  ){
     //Si toutes les données sont saisie par le client

     $client->nom=$_POST['nom'];
     $client->prenom=$_POST['prenom'];
     $client->date_naisance=$_POST['date_naisance'];
     $client->sexe=$_POST['sexe'];
     $client->id=$_GET['id'];

     if($client->modifier()){
        // Ici la modification a fonctionné
        // On envoie un code 200
        http_response_code(200);
        echo json_encode(['success'=>true,
        "message" => "La modification a ete effectuee",
        'result'=>null]);
    }else{
        // Ici la création n'a pas fonctionné
        // On envoie un code 503
        http_response_code(503);
        echo json_encode(['success'=>false,
        "message" => "tt La modification n'a pas été effectuée",
        'result'=>null]);         
    }

}