<?php

    // Headers - first controls access to data,
    // second - allows POST method,
    // third - which http headers can be used
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST');
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
    $monster->name = $data->name;
    $monster->title = $data->title;
    $monster->icon = $data->icon;
    $monster->description = $data->description;
    
    $monster->stats['hp'] = $data->hp;
    $monster->stats['movespeed'] = $data->movespeed;
    $monster->stats['armor'] = $data->armor;
    $monster->stats['spellblock'] = $data->spellblock;
    $monster->stats['attackdamage'] = $data->attackdamage;
    $monster->stats['attackspeedoffset'] = $data->attackspeedoffset;
    $monster->gold = $data->gold;
    $monster->exp = $data->exp;
    $monster->spawnTime = $data->spawnTime;
    $monster->respownTime = $data->respawnTime;
    



    
    if($champion->create_monster()){
        echo json_encode(
            array('message' =>  'Created new monster!')
        );
    } else {
        echo json_encode(
            array('message' => 'Failed to create monster!')
        );
    }