<?php


class DataManager{

    private $api_url; // = 'http://localhost/Lol-Heroes/LoL-Champions-Website/php-champions-rest-api/api/champion/';
    // public $champion_data;

    public function __construct($url){
        $this->api_url = $url;
    }


    public function show_champs_icons($api_func){
        $url = $this->api_url . $api_func;
        $json_data = file_get_contents($url);
        $champion_data = json_decode($json_data);
        $cond = TRUE;
        $counter = 0;
        $records_num = count($champion_data);

        // print data for debuggin purpose
        // print_r($champion_data[0]->icon);
        echo '<div class="champ-list">';

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
                echo '<div class="champ">';
                echo '<img src="' . $champion_data[$counter]->icon . '" style="padding:0.3em 0.3em 0.3em 0.3em"> <br>';
                echo  $champion_data[$counter]->name;
                echo  $champion_data[$counter]->title;
                echo '</div>';
                $counter++;
            }
        }
    }

    


}