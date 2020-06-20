<?php

    // Headers - first controls access to data,
    // second - allows POST method,
    // third - which http headers can be used
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Access-Control-Allow-Origin, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Buff.php';


    // Instantiate DB and connect
    $database = new Database();
    $db = $database->connect();

    // Create champion object
    $buff = new Buff($db);

    $data = json_decode(file_get_contents("php://input"));

    $buff->id = $data->id;
    $buff->name = $data->name;
    $buff->duration = $data->duration;
    $buff->icon = $data->icon;
    $buff->description = $data->description;
    
    if($buff->create_buff()){
        echo json_encode(
            array('message' =>  'Created new buff!')
        );
    } else {
        echo json_encode(
            array('message' => 'Failed to create buff!')
        );
    }