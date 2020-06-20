<?php

class Monster{

    private $conn;
    private $monster_table = 'monsters';

    // Champion Properties
    public $id;
    public $name;
    public $icon;
    public $description;
    public $gold;
    public $exp;
    public $spawnTime;
    public $respawnTime;
    public $stats = [
        'hp' => 0.0,
        'armor' => 0.0,
        'spellblock' => 0.0,
        'attackdamage' => 0.0,
        'attackspeedoffset' => 0.0,
        'movespeed' => 0.0,
    ];

    // Connect to given db on object creation
    public function __construct($db){
        $this->conn = $db;
    }

    public function show_all_monsters(){
        $query = $this->conn->prepare('SELECT * FROM
                ' . $this->monster_table . ' 
            ORDER BY name ASC');

        $query->execute();
        
        return $query;
    }


    // Show all info on requested monster
    public function show_monster(){
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
                m.respawntime
            FROM
                ' . $this->monster_table . ' m 
            WHERE
                m.name = :name
            LIMIT 0,1');

        $query->bindParam(':name', $this->name);
        $query->execute();

        $row = $query->fetch(PDO::FETCH_ASSOC);

        // Set properties
        $this->id = $row['id'];
        $this->name = $row['name'];
        $this->icon = $row['icon'];
        $this->description = $row['description'];
        $this->gold = $row['gold'];;
        $this->exp = $row['exp'];
        $this->spawnTime = $row['spawntime'];
        $this->respawnTime = $row['respawntime'];
        $this->stats['hp'] = $row['hp'];
        $this->stats['armor'] = $row['armor'];
        $this->stats['spellblock'] = $row['spellblock'];
        $this->stats['attackdamage'] = $row['attackdamage'];
        $this->stats['attackspeedoffset'] = $row['attackspeedoffset'];
        $this->stats['movespeed'] = $row['movespeed'];

        return $query;

    }

    // Adding new champ to db
    public function create_monster(){
        $query = $this->conn->prepare('INSERT INTO ' . $this->monster_table . '
            SET
                id = :id,
                name = :name,
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
        $query->bindParam(':icon', $this->icon);
        $query->bindParam(':description', $this->description);
        $query->bindParam(':gold', $this->gold);
        $query->bindParam(':exp', $this->exp);
        $query->bindParam(':spawntime', $this->spawnTime);
        $query->bindParam(':respawntime', $this->respawnTime);
        $query->bindParam(':hp', $this->stats['hp']);
        $query->bindParam(':movespeed', $this->stats['movespeed']);
        $query->bindParam(':armor', $this->stats['armor']);
        $query->bindParam(':spellblock', $this->stats['spellblock']);
        $query->bindParam(':attackdamage', $this->stats['attackdamage']);
        $query->bindParam(':attackspeedoffset', $this->stats['attackspeedoffset']);


        if($query->execute()){
            return true;
        } else {  
            print_r($query->errorInfo());
            printf("Failed to add monster!");
            return false;
        } 
    }

    public function update_monster(){
        $query = $this->conn->prepare('UPDATE ' . $this->monster_table . '
            SET
                id = :id,
                name = :name,
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
                movespeed = :movespeed
            WHERE
                id = :id');


        // binding parameters
        $query->bindParam(':id', $this->id);
        $query->bindParam(':name', $this->name);
        $query->bindParam(':icon', $this->icon);
        $query->bindParam(':description', $this->description);
        $query->bindParam(':gold', $this->gold);
        $query->bindParam(':exp', $this->exp);
        $query->bindParam(':spawntime', $this->spawnTime);
        $query->bindParam(':respawntime', $this->respawnTime);
        $query->bindParam(':hp', $this->stats['hp']);
        $query->bindParam(':movespeed', $this->stats['movespeed']);
        $query->bindParam(':armor', $this->stats['armor']);
        $query->bindParam(':spellblock', $this->stats['spellblock']);
        $query->bindParam(':attackdamage', $this->stats['attackdamage']);
        $query->bindParam(':attackspeedoffset', $this->stats['attackspeedoffset']);

        if($query->execute()){
            return true;
        } else {  
            print_r($query->errorInfo());
            return false;
        } 
    }

    public function delete_monster(){
        $query = $this->conn->prepare('DELETE FROM ' . $this->monster_table . ' WHERE id = :id');
        $query->bindParam(':id', $this->id);


        if($query->execute()){
            return true;
        } else {  
            print_r($query->errorInfo());
            printf('Failed to delete monster');
            return false;
        } 
    }
}