<?php

    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Buff.php';


    // Instantiate DB and connect
    $database = new Database();
    $db = $database->connect();

    // Create champion object
    $buffs = new Buff($db);

    $results = $buffs->show_all_buffs();
    $row_count = $results->rowCount();

    if($row_count > 0){

        $buffs_arr = array();

        while($row = $results->fetch(PDO::FETCH_ASSOC)){
            extract($row);
    
            $buffs_info = array(
                'id' => $id,
                'name' => $name,
                'icon' => $icon,
                'description' => $description,
                'duration' => $duration,
            );
            array_push($buffs_arr, $buffs_info);
        }

        echo json_encode($buffs_arr);
    
    } else {
        echo json_encode(array('message' => 'No buffs in database'));
    }



    