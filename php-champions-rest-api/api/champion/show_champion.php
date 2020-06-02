<?php

    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Champion.php';


    // Instantiate DB and connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate champion object
    $champion = new Champion($db);

    //check if there is a champion with given name, if not then do nothing
    $champion->name = isset($_GET['name']) ? $_GET['name'] : die();

    $champion->show_champion();

    $champion_arr = array(
        'id' => $champion->id,
        'name' => $champion->name,
        'title' => $champion->title,
        'icon' => $champion->icon,
        'description' => $champion->description,
    );

    // adding stats array to champ arr
    $champion_arr = array_merge($champion_arr, $champion->stats);

    //Make JSON
    print_r(json_encode($champion_arr));
