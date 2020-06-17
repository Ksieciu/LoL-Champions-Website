<?php

class Monster{

    private $db_host = 'localhost';
    private $db_name = 'lol-portal';
    private $db_user = 'lol_root';
    private $db_pass = 'root';
    private $conn;
    public $dns;
    private $monster_table = 'monsters';

    // Champion Properties
    // public $id;
    // public $name;
    // public $icon;
    // public $description;
    // public $gold;
    // public $exp;
    // public $spawnTime;
    // public $respawnTime;
    public $monster_data = [
        'id' => 0,
        'name' => Null,
        'icon' => Null,
        'description' => Null,
        'gold' => 0,
        'exp' => 0,
        'spawnTime' => 0,
        'respawnTime' => 0,
        'hp' => 0.0,
        'armor' => 0.0,
        'spellblock' => 0.0,
        'attackdamage' => 0.0,
        'attackspeedoffset' => 0.0,
        'movespeed' => 0.0,
    ];

    // Connect to given db on object creation
    public function __construct(){
        $dsn = 'mysql:host=' . $this->db_host . ';dbname=' . $this->db_name . ";charset=utf8";
        $conn = new PDO($dsn, $this->db_user, $this->db_pass);
        $this->conn = $conn; 
    }

    public function show_all_monsters(){
        $query = $this->conn->prepare('SELECT
                m.id,
                m.name,
                m.icon,
                m.description,
                m.hp,
                m.armor,
                m.spellblock,
                m.attackdamage,
                m.attackspeedoffset,
                m.movespeed,
                m.gold,
                m.exp,
                m.spawntime,
                m.resprawntime
            FROM
                ' . $this->monster_table . ' m 
            ORDER BY
                c.name ASC');

        $query->execute();
        $data = $query->fetchAll();
        
        return $data;
    }


    // Show all info on requested monster
    public function show_monster($id){
        $query = $this->conn->prepare('SELECT
                m.id,
                m.name,
                m.icon,
                m.description,
                m.hp,
                m.armor,
                m.spellblock,
                m.attackdamage,
                m.attackspeedoffset,
                m.movespeed,
                m.gold,
                m.exp,
                m.spawntime,
                m.resprawntime
            FROM
                ' . $this->monster_table . ' m 
            WHERE
                m.id = :id
            LIMIT 0,1');

        $query->bindParam(':id', $id);
        $query->execute();

        $row = $query->fetch(PDO::FETCH_ASSOC);

        // Set properties
        // $this->id = $row['id'];
        // $this->name = $row['name'];
        // $this->title = $row['title'];
        // $this->icon = $row['icon'];
        // $this->description = $row['description'];
        // $this->$gold = $row['gold'];;
        // $this->$exp = $row['exp'];;
        // $this->$spawnTime = $row['spawntime'];;
        // $this->$respawnTime = $row['respawntime'];;
        // $this->monster_data['hp'] = $row['hp'];
        // $this->monster_data['armor'] = $row['armor'];
        // $this->monster_data['spellblock'] = $row['spellblock'];
        // $this->monster_data['attackdamage'] = $row['attackdamage'];
        // $this->monster_data['attackspeedoffset'] = $row['attackspeedoffset'];
        // $this->monster_data['movespeed'] = $row['movespeed'];

        return $row;

    }

    // Adding new champ to db
    public function create_monster(){
        $query = $this->conn->prepare('INSERT INTO ' . $this->monster_table . '
            SET
                id = :id,
                name = :name,
                title = :title,
                icon = :icon,
                description = :description,
                gold = :gold,
                exp = :exp,
                spawntime = :spawntime,
                respawntime = :respawntime,
                hp = :hp,
                armor = :armor,
                spellblock = :spellblock,
                attackdamage = :attackdamage,
                attackspeedoffset = :attackspeedoffset,
                movespeed = :movespeed');
        

        // binding parameters
        $query->bindParam(':id', $this->id);
        $query->bindParam(':name', $this->name);
        $query->bindParam(':title', $this->title);
        $query->bindParam(':icon', $this->icon);
        $query->bindParam(':description', $this->description);
        $query->bindParam(':gold', $this->gold);
        $query->bindParam(':exp', $this->exp);
        $query->bindParam(':spawntime', $this->spawnTime);
        $query->bindParam(':resprawntime', $this->resprawnTime);
        $query->bindParam(':hp', $this->monster_data['hp']);
        $query->bindParam(':movespeed', $this->monster_data['movespeed']);
        $query->bindParam(':armor', $this->monster_data['armor']);
        $query->bindParam(':spellblock', $this->monster_data['spellblock']);
        $query->bindParam(':attackdamage', $this->monster_data['attackdamage']);
        $query->bindParam(':attackspeedoffset', $this->monster_data['attackspeedoffset']);


        if($query->execute()){
            return true;
        } else {  
            print_r($query->errorInfo());
            printf("Failed to add monster!");
            return false;
        } 
    }
}

$options = array('uri' => '/php-monsters-soap/Server.php');
$server = new SoapServer(Null, $options);
$server->setClass('Server');
$server->handle();