<?php

    class Database {
        
        private $db_host = 'localhost';
        private $db_name = 'lol-portal';
        private $db_user = 'lol_root';
        private $db_pass = 'root';
        private $conn;
        public $dns;


        // Connection with database starts after running this function(I was thinking about making it with constructor, but let's make it work this way)
        public function connect() {
            try{
                $dsn = 'mysql:host=' . $this->db_host . ';dbname=' . $this->db_name . ";charset=utf8";
                $conn = new PDO($dsn, $this->db_user, $this->db_pass);
                $this->conn = $conn; 
                // $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch(PDOException $e) {
                echo 'kaczyński śmieć';
                echo $e->getMessage();
            }

            return $this->conn;
        }
    }