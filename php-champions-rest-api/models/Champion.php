<?php

    class Champion{
        private $conn;
        private $champ_table = 'champions';
        private $stats_table = 'statistics';

        // Champion Properties
        public $id;
        public $name;
        public $title;
        public $icon;
        public $description;
        public $stats = [
            'hp' => 0.0,
            'hpperlevel' => 0.0,
            'mp' => 0.0,
            'mpperlevel' => 0.0,
            'movespeed' => 0.0,
            'armor' => 0.0,
            'armorperlevel' => 0.0,
            'spellblock' => 0.0,
            'spellblockperlevel' => 0.0,
            'attackrange' => 0.0,
            'hpregen' => 0.0,
            'hpregenperlevel' => 0.0,
            'mpregen' => 0.0,
            'mpregenperlevel' => 0.0,
            'crit' => 0.0,
            'critperlevel' => 0.0,
            'attackdamage' => 0.0,
            'attackdamageperlevel' => 0.0,
            'attackspeedoffset' => 0.0,
            'attackspeedperlevel' => 0.0,
        ];

        // Connect to given db on object creation
        public function __construct($db){
            $this->conn = $db;
        }

        public function show_all_champions(){
            $query = $this->conn->prepare('SELECT
                    c.id,
                    c.name,
                    c.title,
                    c.icon,
                    c.description,
                    s.hp,
                    s.hpperlevel,
                    s.mp,
                    s.mpperlevel,
                    s.movespeed,
                    s.armor,
                    s.armorperlevel,
                    s.spellblock,
                    s.spellblockperlevel,
                    s.attackrange,
                    s.hpregen,
                    s.hpregenperlevel,
                    s.mpregen,
                    s.mpregenperlevel,
                    s.crit,
                    s.critperlevel,
                    s.attackdamage,
                    s.attackdamageperlevel,
                    s.attackspeedoffset,
                    s.attackspeedperlevel
                FROM
                    ' . $this->champ_table . ' c 
                LEFT JOIN 
                    ' . $this->stats_table . ' s ON c.id = s.id
                ORDER BY
                    c.name ASC');

            $query->execute();
            
            return $query;
        }


        // Show all info on given champion
        public function show_champion(){
            $query = $this->conn->prepare('SELECT
                    c.id,
                    c.name,
                    c.title,
                    c.icon,
                    c.description,
                    s.hp,
                    s.hpperlevel,
                    s.mp,
                    s.mpperlevel,
                    s.movespeed,
                    s.armor,
                    s.armorperlevel,
                    s.spellblock,
                    s.spellblockperlevel,
                    s.attackrange,
                    s.hpregen,
                    s.hpregenperlevel,
                    s.mpregen,
                    s.mpregenperlevel,
                    s.crit,
                    s.critperlevel,
                    s.attackdamage,
                    s.attackdamageperlevel,
                    s.attackspeedoffset,
                    s.attackspeedperlevel
                FROM
                    ' . $this->champ_table . ' c 
                LEFT JOIN
                    ' . $this->stats_table . ' s ON c.id = s.id
                WHERE
                    c.name = :name
                LIMIT 0,1');

            $query->bindParam(':name', $this->name);
            $query->execute();

            $row = $query->fetch(PDO::FETCH_ASSOC);

            // Set properties
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->title = $row['title'];
            $this->icon = $row['icon'];
            $this->description = $row['description'];
            $this->stats['hp'] = $row['hp'];
            $this->stats['hpperlevel'] = $row['hpperlevel'];
            $this->stats['mp'] = $row['mp'];
            $this->stats['mpperlevel'] = $row['mpperlevel'];
            $this->stats['movespeed'] = $row['movespeed'];
            $this->stats['armor'] = $row['armor'];
            $this->stats['armorperlevel'] = $row['armorperlevel'];
            $this->stats['spellblock'] = $row['spellblock'];
            $this->stats['spellblockperlevel'] = $row['spellblockperlevel'];
            $this->stats['attackrange'] = $row['attackrange'];
            $this->stats['hpregen'] = $row['hpregen'];
            $this->stats['hpregenperlevel'] = $row['hpregenperlevel'];
            $this->stats['mpregen'] = $row['mpregen'];
            $this->stats['mpregenperlevel'] = $row['mpregenperlevel'];
            $this->stats['crit'] = $row['crit'];
            $this->stats['critperlevel'] = $row['critperlevel'];
            $this->stats['attackdamage'] = $row['attackdamage'];
            $this->stats['attackdamageperlevel'] = $row['attackdamageperlevel'];
            $this->stats['attackspeedoffset'] = $row['attackspeedoffset'];
            $this->stats['attackspeedperlevel'] = $row['attackspeedperlevel'];
            

            return $query;

        }

        // Adding new champ to db
        public function create_champion(){
            $champion_query = $this->conn->prepare('INSERT INTO ' . $this->champ_table . '
                SET
                    id = :id,
                    name = :name,
                    title = :title,
                    icon = :icon,
                    description = :description');
            
            // cleaning data
            // $this->name = htmlspecialchars(strip_tags($this->name));
            // $this->title = htmlspecialchars(strip_tags($this->title));
            // $this->icon = htmlspecialchars(strip_tags($this->icon));
            // $this->description = htmlspecialchars(strip_tags($this->description));

            // binding parameters
            $champion_query->bindParam(':id', $this->id);
            $champion_query->bindParam(':name', $this->name);
            $champion_query->bindParam(':title', $this->title);
            $champion_query->bindParam(':icon', $this->icon);
            $champion_query->bindParam(':description', $this->description);

            // execute query, if failed print error and return false
            // if(!($champion_query->execute())){
            //     printf("Error");
            //     return false;
            // }

            $statistics_query = $this->conn->prepare('INSERT INTO ' . $this->stats_table . '
            SET
                id = :id,
                hp = :hp,
                hpperlevel = :hpperlevel,
                mp = :mp,
                mpperlevel = :mpperlevel,
                movespeed = :movespeed,
                armor = :armor,
                armorperlevel = :armorperlevel,
                spellblock = :spellblock,
                spellblockperlevel = :spellblockperlevel,
                attackrange = :attackrange,
                hpregen = :hpregen,
                hpregenperlevel = :hpregenperlevel,
                mpregen = :mpregen,
                mpregenperlevel = :mpregenperlevel,
                crit = :crit,
                critperlevel = :critperlevel,
                attackdamage = :attackdamage,
                attackdamageperlevel = :attackdamageperlevel,
                attackspeedoffset = :attackspeedoffset,
                attackspeedperlevel = :attackspeedperlevel');

            // binding parameters
            $statistics_query->bindParam(':id', $this->id);
            $statistics_query->bindParam(':hp', $this->stats['hp']);
            $statistics_query->bindParam(':hpperlevel', $this->stats['hpperlevel']);
            $statistics_query->bindParam(':mp', $this->stats['mp']);
            $statistics_query->bindParam(':mpperlevel', $this->stats['mpperlevel']);
            $statistics_query->bindParam(':movespeed', $this->stats['movespeed']);
            $statistics_query->bindParam(':armor', $this->stats['armor']);
            $statistics_query->bindParam(':armorperlevel', $this->stats['armorperlevel']);
            $statistics_query->bindParam(':spellblock', $this->stats['spellblock']);
            $statistics_query->bindParam(':spellblockperlevel', $this->stats['spellblockperlevel']);
            $statistics_query->bindParam(':attackrange', $this->stats['attackrange']);
            $statistics_query->bindParam(':hpregen', $this->stats['hpregen']);
            $statistics_query->bindParam(':hpregenperlevel', $this->stats['hpregenperlevel']);
            $statistics_query->bindParam(':mpregen', $this->stats['mpregen']);
            $statistics_query->bindParam(':mpregenperlevel', $this->stats['mpregenperlevel']);
            $statistics_query->bindParam(':crit', $this->stats['crit']);
            $statistics_query->bindParam(':critperlevel', $this->stats['critperlevel']);
            $statistics_query->bindParam(':attackdamage', $this->stats['attackdamage']);
            $statistics_query->bindParam(':attackdamageperlevel', $this->stats['attackdamageperlevel']);
            $statistics_query->bindParam(':attackspeedoffset', $this->stats['attackspeedoffset']);
            $statistics_query->bindParam(':attackspeedperlevel', $this->stats['attackspeedperlevel']);

            if($champion_query->execute()){
                if(!($statistics_query->execute())){
                    print_r($statistics_query->errorInfo());
                    printf("Failed to add statistics to champion");
                }
                return true;
            } else {  
                return false;
            } 
        }


        public function update_champion(){
            $champion_query = $this->conn->prepare('UPDATE ' . $this->champ_table . '
                SET
                    id = :id,
                    name = :name,
                    title = :title,
                    icon = :icon,
                    description = :description
                WHERE
                    id = :id');
            

            // binding parameters
            $champion_query->bindParam(':id', $this->id);
            $champion_query->bindParam(':name', $this->name);
            $champion_query->bindParam(':title', $this->title);
            $champion_query->bindParam(':icon', $this->icon);
            $champion_query->bindParam(':description', $this->description);

            // execute query, if failed print error and return false
            // if(!($champion_query->execute())){
            //     printf("Error");
            //     return false;
            // }

            $statistics_query = $this->conn->prepare('UPDATE ' . $this->stats_table . '
            SET
                id = :id,
                hp = :hp,
                hpperlevel = :hpperlevel,
                mp = :mp,
                mpperlevel = :mpperlevel,
                movespeed = :movespeed,
                armor = :armor,
                armorperlevel = :armorperlevel,
                spellblock = :spellblock,
                spellblockperlevel = :spellblockperlevel,
                attackrange = :attackrange,
                hpregen = :hpregen,
                hpregenperlevel = :hpregenperlevel,
                mpregen = :mpregen,
                mpregenperlevel = :mpregenperlevel,
                crit = :crit,
                critperlevel = :critperlevel,
                attackdamage = :attackdamage,
                attackdamageperlevel = :attackdamageperlevel,
                attackspeedoffset = :attackspeedoffset,
                attackspeedperlevel = :attackspeedperlevel
            WHERE id = :id');

            // binding parameters
            $statistics_query->bindParam(':id', $this->id);
            $statistics_query->bindParam(':hp', $this->stats['hp']);
            $statistics_query->bindParam(':hpperlevel', $this->stats['hpperlevel']);
            $statistics_query->bindParam(':mp', $this->stats['mp']);
            $statistics_query->bindParam(':mpperlevel', $this->stats['mpperlevel']);
            $statistics_query->bindParam(':movespeed', $this->stats['movespeed']);
            $statistics_query->bindParam(':armor', $this->stats['armor']);
            $statistics_query->bindParam(':armorperlevel', $this->stats['armorperlevel']);
            $statistics_query->bindParam(':spellblock', $this->stats['spellblock']);
            $statistics_query->bindParam(':spellblockperlevel', $this->stats['spellblockperlevel']);
            $statistics_query->bindParam(':attackrange', $this->stats['attackrange']);
            $statistics_query->bindParam(':hpregen', $this->stats['hpregen']);
            $statistics_query->bindParam(':hpregenperlevel', $this->stats['hpregenperlevel']);
            $statistics_query->bindParam(':mpregen', $this->stats['mpregen']);
            $statistics_query->bindParam(':mpregenperlevel', $this->stats['mpregenperlevel']);
            $statistics_query->bindParam(':crit', $this->stats['crit']);
            $statistics_query->bindParam(':critperlevel', $this->stats['critperlevel']);
            $statistics_query->bindParam(':attackdamage', $this->stats['attackdamage']);
            $statistics_query->bindParam(':attackdamageperlevel', $this->stats['attackdamageperlevel']);
            $statistics_query->bindParam(':attackspeedoffset', $this->stats['attackspeedoffset']);
            $statistics_query->bindParam(':attackspeedperlevel', $this->stats['attackspeedperlevel']);


            if($champion_query->execute()){
                if(!($statistics_query->execute())){
                    print_r($statistics_query->errorInfo());
                    printf("Failed to update statistics to champion");
                }
                return true;
            } else {  
                print_r($champion_query->errorInfo());
                return false;
            } 
        }


        public function delete_champion(){
            $champion_query = $this->conn->prepare('DELETE FROM ' . $this->champ_table . ' WHERE id = :id');
            $champion_query->bindParam(':id', $this->id);

            $statistics_query = $this->conn->prepare('DELETE FROM ' . $this->stats_table . ' WHERE id = :id');
            $statistics_query->bindParam(':id', $this->id);

            if($champion_query->execute()){
                if(!($statistics_query->execute())){
                    print_r($statistics_query->errorInfo());
                    printf("Failed to delete statistics of champion");
                }
                return true;
            } else {  
                print_r($champion_query->errorInfo());
                printf('Failed to delete champion');
                return false;
            } 
        }
    }