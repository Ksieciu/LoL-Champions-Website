<?php

    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Champion.php';


    // Instantiate DB and connect
    $database = new Database();
    $db = $database->connect();

    // Create champion object
    $champion = new Champion($db);

    $results = $champion->show_all_champions();
    $row_count = $results->rowCount();

    if($row_count > 0){

        $champions_arr = array();

        while($row = $results->fetch(PDO::FETCH_ASSOC)){
            extract($row);
    
            $champion_info = array(
                'id' => $id,
                'name' => $name,
                'title' => $title,
                'icon' => $icon,
                'description' => $description,
                'hp' => $hp,
                'hpperlevel' => $hpperlevel,
                'mp' => $mp,
                'mpperlevel' => $mpperlevel,
                'movespeed' => $movespeed,
                'armor' => $armor,
                'armorperlevel' => $armorperlevel,
                'spellblock' => $spellblock,
                'spellblockperlevel' => $spellblockperlevel,
                'attackrange' => $attackrange,
                'hpregen' => $hpregen,
                'hpregenperlevel' => $hpregenperlevel,
                'mpregen' => $mpregen,
                'mpregenperlevel' => $mpregenperlevel,
                'crit' => $crit,
                'critperlevel' => $critperlevel,
                'attackdamage' => $attackdamage,
                'attackdamageperlevel' => $attackdamageperlevel,
                'attackspeedoffset' => $attackspeedoffset,
                'attackspeedperlevel' => $attackspeedperlevel,
            );
            array_push($champions_arr, $champion_info);
        }

        echo json_encode($champions_arr);
    
    } else {
        echo json_encode(array('message' => 'No champions in database'));
    }



    