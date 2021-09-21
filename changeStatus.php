<?php
// Headers requis
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


    // On inclut les fichiers de configuration et d'accès aux données
    include_once 'config/Database.php';
    include_once 'models/client.php';

    // On instancie la base de données
    $database = new Database();
    $db = $database->getConnection();

    // On instancie les clients
    $client = new client($db);

    // On récupère l'id et le status du client
   
    if(!empty($_GET)){
        $client->id = $_GET['id'];
        $client->status = $_GET['status'];
        if($client->status()){
            // Ici la suppression a fonctionné
            // On envoie un code 200
            http_response_code(200);
            echo json_encode(['success'=>true,
                "message" => "status changer avec success",
                'result'=>null]);
        }else{
            // Ici la création n'a pas fonctionné
            // On envoie un code 503
            http_response_code(503);
            echo json_encode(['success'=>false,
                "message" => "echec de changement du status",
                'result'=>null]);         
        }
    }