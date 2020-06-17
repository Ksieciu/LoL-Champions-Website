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

        if($query->rowCount() > 0){
            throw new SOAPFault(401, 'Account with that email already exists!');
        } else {
            $query = $this->conn->prepare('INSERT INTO ' . 'users' . '
            SET
                email = :email,
                password = :password
                ');

            // binding parameters
            $query->bindParam(':email', $header_params->email);
            $query->bindParam(':password', $header_params->password);

            if($query->execute()){
                
                echo "Account created!";
                return true;
            } else {  
                echo '<script language="javascript">';
        echo 'alert("message successfully sent")';
        echo '</script>';
                print_r($query->errorInfo());
                echo "Failed to create an account!";
                return false;
            } 

        }
    }

}


$options = array('uri' => 'localhost/LoL-Champions-Website/php-monsters-soap/Server.php');
$server = new SoapServer(Null, $options);
$server->setClass('Server');
$server->handle();