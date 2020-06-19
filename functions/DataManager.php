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
                echo  $champion_data[$counter]->name  . '<br>';
                echo  $champion_data[$counter]->title ;
                echo  '<br><button type="submit" class="fav-btn" method="Post" >
                <svg class="bi bi-heart" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/></a>
              </svg></button>' ;
               echo '<form style="display:auto" method="post" action="./details.php"><button type="submit" class="more-btn">More</button></form>';
                echo '</div>';
                $counter++;
            }
        }
    }

    


}