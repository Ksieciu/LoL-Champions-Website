<?php

    // Headers - first controls access to data,
    // second - allows POST method,
    // third - which http headers can be used
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: DELETE');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Access-Control-Allow-Origin, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Champion.php';


    // Instantiate DB and connect
    $database = new Database();
    $db = $database->connect();

    // Create champion object
    $champion = new Champion($db);

    $data = json_decode(file_get_contents("php://input"));

    $champion->id = $data->id;

    if($champion->delete_champion()){
        echo json_encode(
            array('message' =>  'Champion deleted!')
        );
    } else {
        echo json_encode(
            array('message' => 'Failed to delete champion!')
        );
    }