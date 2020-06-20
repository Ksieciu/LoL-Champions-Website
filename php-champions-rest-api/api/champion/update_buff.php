<?php

    // Headers - first controls access to data,
    // second - allows POST method,
    // third - which http headers can be used
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: PUT');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Access-Control-Allow-Origin, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Buff.php';


    // Instantiate DB and connect
    $database = new Database();
    $db = $database->connect();

    // Create buff object
    $buff = new Buff($db);

    $data = json_decode(file_get_contents("php://input"));

    $buff->id = $data->id;
    $buff->name = $data->name;
    $buff->icon = $data->icon;
    $buff->description = $data->description;
    $buff->duration = $data->duration;
    

    if($buff->update_buff()){
        echo json_encode(
            array('message' =>  'buff updated!')
        );
    } else {
        echo json_encode(
            array('message' => 'Failed to update buff!')
        );
    }