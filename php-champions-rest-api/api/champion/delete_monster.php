<?php

    // Headers - first controls access to data,
    // second - allows DELETE method,
    // third - which http headers can be used
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: DELETE');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Access-Control-Allow-Origin, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Monster.php';


    // Instantiate DB and connect
    $database = new Database();
    $db = $database->connect();

    // Create champion object
    $monster = new Monster($db);

    $data = json_decode(file_get_contents("php://input"));

    $monster->id = $data->id;

    if($monster->delete_monster()){
        echo json_encode(
            array('message' =>  'monster deleted!')
        );
    } else {
        echo json_encode(
            array('message' => 'Failed to delete monster!')
        );
    }