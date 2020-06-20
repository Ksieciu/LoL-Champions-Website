<?php

class Server{

    private $db_host = 'localhost';
        private $db_name = 'lol-portal';
        private $db_user = 'lol_root';
        private $db_pass = 'root';
        private $conn;
        public $dns;


    // try to connect to db on instance creation
    public function __construct(){
        $this->conn = (is_null($this->conn)) ? self::connect() : $this->conn; 
    }

    public function connect() {
        try{
            $dsn = 'mysql:host=' . $this->db_host . ';dbname=' . $this->db_name . ";charset=utf8";
            $conn = new PDO($dsn, $this->db_user, $this->db_pass);
            $this->conn = $conn; 
            // $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch(PDOException $e) {
            echo $e->getMessage();
        }
        return $this->conn;
    }

    // public static function authenticate($header_params){
    //     if($header_params->username == 'name' && $header_params->password == 'password') {
    //         return true;
    //     }
    //     else throw new SOAPFault('Wrong username or password!', 401);
    // }

    public function register($header_params){
        $query = $this->conn->prepare('SELECT id FROM users WHERE email = :email');
        $query->bindParam(':email', $header_params->email);
        $query->execute();

        // check if there is already account with given email
        // if not, then create account
        if($query->rowCount() > 0){
            echo "Failed to create an account!";
            return false;
        } else {
            $query = $this->conn->prepare('INSERT INTO ' . 'users' . '
                SET
                    email = :email,
                    password = :password
                    ');

            $query->bindParam(':email', $header_params->email);
            $query->bindParam(':password', $header_params->password);

            if($query->execute()){
                echo "Account created!";
                return true;
            } else {  
                print_r($query->errorInfo());
                echo "Failed to create an account!";
                return false;
            } 
        }
    }

    public function login($header_params){
        $query = $this->conn->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
        $query->bindParam(':email', $header_params->email);
        $query->execute();

        $row = $query->fetch(PDO::FETCH_ASSOC);
        $result = new stdClass();

        if($row['email'] = $header_params->email){
            if($row['password'] !== $header_params->password){
                $result->msg = "Wrong password!";
                $result->success = false;
                // $result->email = $row['email'];
                return $result;
            } else {
                $result->msg = "You have succesfully logged in!";
                $result->success = true;
                $result->email = $row['email'];
                $result->id = $row['id'];
                return $result;
            }
        } else {
            $result->msg = "There is no such email in database!";
            $result->success = false;
            return $result;
        }
    }

}


$options = array('uri' => 'localhost/Lol-Heroes/LoL-Champions-Website/php-soap-account/Server.php');
$server = new SoapServer(Null, $options);
$server->setClass('Server');
$server->handle();
