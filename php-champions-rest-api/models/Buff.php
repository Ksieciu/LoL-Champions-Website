<?php

class Buff{

    private $conn;
    private $buffs_table = 'buffs';

    // Champion Properties
    public $id;
    public $name;
    public $icon;
    public $description;
    public $duration;

    // Connect to given db on object creation
    public function __construct($db){
        $this->conn = $db;
    }

    public function show_all_buffs(){
        $query = $this->conn->prepare('SELECT * FROM
                ' . $this->buffs_table . ' 
            ORDER BY name ASC');

        $query->execute();
        
        return $query;
    }


    // Show all info on requested buff
    public function show_buff(){
        $query = $this->conn->prepare('SELECT
                id,
                name,
                icon,
                description,
                duration
            FROM
                ' . $this->buffs_table . '  
            WHERE
                name = :name
            LIMIT 0,1');

        $query->bindParam(':name', $this->name);
        $query->execute();

        $row = $query->fetch(PDO::FETCH_ASSOC);

        // Set properties
        $this->id = $row['id'];
        $this->name = $row['name'];
        $this->icon = $row['icon'];
        $this->description = $row['description'];
        $this->duration = $row['duration'];;

        return $query;

    }

    // Adding new champ to db
    public function create_buff(){
        $query = $this->conn->prepare('INSERT INTO ' . $this->buffs_table . '
            SET
                id = :id,
                name = :name,
                icon = :icon,
                description = :description,
                duration = :duration');
        

        // binding parameters
        $query->bindParam(':id', $this->id);
        $query->bindParam(':name', $this->name);
        $query->bindParam(':icon', $this->icon);
        $query->bindParam(':description', $this->description);
        $query->bindParam(':duration', $this->duration);


        if($query->execute()){
            return true;
        } else {  
            print_r($query->errorInfo());
            printf("Failed to add buff!");
            return false;
        } 
    }

    public function update_buff(){
        $query = $this->conn->prepare('UPDATE ' . $this->buffs_table . '
            SET
                id = :id,
                name = :name,
                icon = :icon,
                description = :description,
                duration = :duration
            WHERE
                id = :id');


        // binding parameters
        $query->bindParam(':id', $this->id);
        $query->bindParam(':name', $this->name);
        $query->bindParam(':icon', $this->icon);
        $query->bindParam(':description', $this->description);
        $query->bindParam(':duration', $this->duration);

        if($query->execute()){
            return true;
        } else {  
            print_r($query->errorInfo());
            return false;
        } 
    }

    public function delete_buff(){
        $query = $this->conn->prepare('DELETE FROM ' . $this->buffs_table . ' WHERE id = :id');
        $query->bindParam(':id', $this->id);


        if($query->execute()){
            return true;
        } else {  
            print_r($query->errorInfo());
            printf('Failed to delete buff');
            return false;
        } 
    }
}