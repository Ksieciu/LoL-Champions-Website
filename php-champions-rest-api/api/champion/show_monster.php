<?php

    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Monster.php';


    // Instantiate DB and connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate champion object
    $monster = new Monster($db);

    //check if there is a monster with given name, if not then do nothing
    $monster->name = isset($_GET['name']) ? $_GET['name'] : die();

    $monster->show_monster();

    $monster_arr = array(
        'icon' => $monster->icon,
        'id' => $monster->id,
        'name' => $monster->name,
        'description' => $monster->description,
        'gold' => $monster->gold,
        'exp' => $monster->exp,
        'spawnTime' => $monster->spawnTime,
        'respawnTime' => $monster->respawnTime,
    );

    $monster_arr = array_merge($monster_arr, $monster->stats);

    //Make JSON
    print_r(json_encode($monster_arr));
