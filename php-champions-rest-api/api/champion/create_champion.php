<?php

    // Headers - first controls access to data,
    // second - allows POST method,
    // third - which http headers can be used
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Access-Control-Allow-Origin, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Champion.php';


    // Instantiate DB and connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate champion object
    $champion = new Champion($db);

    $data = json_decode(file_get_contents("php://input"));

    $champion->id = $data->id;
    $champion->name = $data->name;
    $champion->title = $data->title;
    $champion->icon = $data->icon;
    $champion->description = $data->description;
    
    $champion->stats['hp'] = $data->hp;
    $champion->stats['hpperlevel'] = $data->hpperlevel;
    $champion->stats['mp'] = $data->mp;
    $champion->stats['mpperlevel'] = $data->mpperlevel;
    $champion->stats['movespeed'] = $data->movespeed;
    $champion->stats['armor'] = $data->armor;
    $champion->stats['armorperlevel'] = $data->armorperlevel;
    $champion->stats['spellblock'] = $data->spellblock;
    $champion->stats['spellblockperlevel'] = $data->spellblockperlevel;
    $champion->stats['attackrange'] = $data->attackrange;
    $champion->stats['hpregen'] = $data->hpregen;
    $champion->stats['hpregenperlevel'] = $data->hpregenperlevel;
    $champion->stats['mpregen'] = $data->mpregen;
    $champion->stats['mpregenperlevel'] = $data->mpregenperlevel;
    $champion->stats['crit'] = $data->crit;
    $champion->stats['critperlevel'] = $data->critperlevel;
    $champion->stats['attackdamage'] = $data->attackdamage;
    $champion->stats['attackdamageperlevel'] = $data->attackdamageperlevel;
    $champion->stats['attackspeedoffset'] = $data->attackspeedoffset;
    $champion->stats['attackspeedperlevel'] = $data->attackspeedperlevel;

    if($champion->create_champion()){
        echo json_encode(
            array('message' =>  'Created new champion!')
        );
    } else {
        echo json_encode(
            array('message' => 'Failed to create champion!')
        );
    }