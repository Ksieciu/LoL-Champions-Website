<?php


class MonsterManager{

    private $api_url; // = 'http://localhost/Lol-Heroes/LoL-Champions-Website/php-champions-rest-api/api/champion/';
    // public $champion_data;

    public function __construct($url){
        $this->api_url = $url;
    }


    public function show_monsters_icons($api_func){
        $url = $this->api_url . $api_func;
        $json_data = file_get_contents($url);
        $monster_data = json_decode($json_data);
        $cond = TRUE;
        $counter = 0;
        $records_num = count($monster_data);

        // print data for debuggin purpose
        // print_r($champion_data[0]->icon);
        echo '<div class="monster-list">';

        // while for creating rows
        while($cond){
          //  echo '<div class="row">';

            // loop for making number of columns, if no more champs, then break for and while loops.
            for($i = 0; $i < 8; $i++){
                if($counter >= $records_num){
                    $cond = FALSE;
                    break;
                }
                // making divs for columns, printing champions icons
                echo '<div class="monster">';
                echo '<img src="' . $monster_data[$counter]->icon . '" style="padding:0.5em 0.5em 0.5em 0.5em"> <br>';
                echo  $monster_data[$counter]->name;
                echo '<form style="display:auto" method="get" action="./details.php"><button type="submit" class="more-btn">More</button></form>';
                echo '</div>';
                $counter++;
            }
        }
    }

    


}