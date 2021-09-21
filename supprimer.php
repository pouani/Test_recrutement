<?php
// Headers requis
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
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

    // On récupère l'id du client
    if(!empty($_GET['Supid'])){
        $client->id = $_GET['Supid'];

        if($client->supprimer()){
            // Ici la suppression a fonctionné
            // On envoie un code 200
            http_response_code(200);
            echo json_encode(['success'=>true,
                "message" => "La suppression a ete effectuee",
                'result'=>null]);
        }else{
            // Ici la création n'a pas fonctionné
            // On envoie un code 503
            http_response_code(503);
            echo json_encode(['success'=>false,
                 "message" => "La suppression n'a pas été effectuée",
                 'result'=>null]);         
        }
    }