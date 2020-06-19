<?php

    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Monster.php';


    // Instantiate DB and connect
    $database = new Database();
    $db = $database->connect();

    // Create champion object
    $monsters = new Monsters($db);

    $results = $monsters->show_all_monsters();
    $row_count = $results->rowCount();

    if($row_count > 0){

        $monsters_arr = array();

        while($row = $results->fetch(PDO::FETCH_ASSOC)){
            extract($row);
    
            $monsters_info = array(
                'id' => $id,
                'name' => $name,
                'title' => $title,
                'icon' => $icon,
                'description' => $description,
                'hp' => $hp,
                'movespeed' => $movespeed,
                'armor' => $armor,
                'spellblock' => $spellblock,
                'attackdamage' => $attackdamage,
                'attackspeedoffset' => $attackspeedoffset,
                'gold' => $gold,
                'exp' => $exp,
                'spawnTime' => $spawnTime,
                'respownTime' => $respawnTime,
        
 
            
            );
            array_push($monsters_arr, $monsters_info);
        }

        echo json_encode( $monsters_arr);
    
    } else {
        echo json_encode(array('message' => 'No champions in database'));
    }



    