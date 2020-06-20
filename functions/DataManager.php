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
               echo '<form style="display:auto" method="post" action="./details.php?name=' . $champion_data[$counter]->name . '"><button type="submit" class="more-btn">More</button></form>';
                echo '</div>';
                $counter++;
            }
        }
    }

    // function for showing all info about specific object(champ, monster, buff)
    public function show_all_info($api_func){
        $url = $this->api_url . $api_func;
        $json_data = file_get_contents($url);
        $data= json_decode($json_data);
        $id = 0;
        if (!$data){
            echo "There is no such object in database!<br>";
            return false;
        }
        
        foreach ($data as $key => $value) {
            if($key == 'id') { 
                $id = $value;
                
                echo  ucfirst($key) . '<br>' .': <input class="input-box-details"  name="' . $key . '" value="' . $value . '"></input><br>';
            }
            elseif($key == 'icon'){
                echo '<img class="details-image" src="' . $value . '" style="padding:0.3em 0.3em 0.3em 0.3em"> <br>';
                echo ucfirst($key) .'<br>' .': <input class="input-box-details" name="' . $key . '" value="' . $value . '"></input><br>';
            } else {
                echo ucfirst($key) .'<br>' . ': <input class="input-box-details" name="' . $key . '" value="' . $value . '"></input><br>';
            }
        }
        echo '<br><button type="submit" class="delete-btn" value="Update champion" name="update">Update champion</button>';
        echo '</form><br>';
        echo '<div class="details">';
        echo '<form method="POST"><button type="submit" class="delete-btn" name="delete" value="Delete champion"> Delete champion</button></form>';
        return $id;
    }

    // delete object based on passed endpoint name and object id
    public function delete_object($api_func, $id){
        $url = $this->api_url . $api_func;
        $arr = array('id' => $id);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arr));
        $result = curl_exec($ch);
        $result = json_decode($result);
        curl_close($ch);

    }

    public function create_champion($arr){
        $url = $this->api_url . 'create_champion.php';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arr));
        $result = curl_exec($ch);
        $result = json_decode($result);
        curl_close($ch);
        return $result;
    }

    public function update_object($api_func, $arr){
        $url = $this->api_url . $api_func;
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arr));
        $result = curl_exec($ch);
        $result = json_decode($result);
        curl_close($ch);
    }

    


}