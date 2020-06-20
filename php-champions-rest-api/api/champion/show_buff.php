<?php

    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Buff.php';


    // Instantiate DB and connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate champion object
    $buff = new Buff($db);

    //check if there is a buff with given name, if not then do nothing
    $buff->name = isset($_GET['name']) ? $_GET['name'] : die();

    $buff->show_buff();

    $buff_arr = array(
        'icon' => $buff->icon,
        'id' => $buff->id,
        'name' => $buff->name,
        'description' => $buff->description,
        'duration' => $buff->duration
    );

    //Make JSON
    print_r(json_encode($buff_arr));
