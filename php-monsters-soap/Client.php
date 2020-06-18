<?php

class Client{

    public function __construct(){
        $params = array('location' => 'http://localhost/lol-champions-website/php-monsters-soap/server.php',
                        'uri' => 'urn://localhost/lol-champions-website/php-monsters-soap/server.php',
                        'trace' => 1);

        $this->instance = new SoapClient(Null, $params);
        
        /*
        // creating empty generic class(alternative to associative array)
        $auth_params = new stdClass();

        // we can use post here
        $auth_params->username = 'name';
        $auth_params->password = 'password';

        // setting header params
        $header_params = new SoapVar($auth_params, SOAP_ENC_OBJECT);
        $header = new SoapHeader('login', 'authenticate', $header_params, false);
        $this->instance->__setSoapHeaders(array($header));*/

    }

    public function register($email, $password){
        $account = new stdClass();
        $account->email = $email;
        $account->password = $password;
        $header_params = new SoapVar($account, SOAP_ENC_OBJECT);
        $header = new SoapHeader('reg', 'register', $header_params, false);
        $this->instance->__setSoapHeaders(array($header));
        return $this->instance->__soapCall('register', array($header_params));
    }

    public function login($email, $password){
        $account = new stdClass();
        $account->email = $email;
        $account->password = $password;
        $header_params = new SoapVar($account, SOAP_ENC_OBJECT);
        $header = new SoapHeader('log', 'login', $header_params, false);
        $this->instance->__setSoapHeaders(array($header));
        return $this->instance->__soapCall('login', array($header_params));
    }

    public function getName($id_array){
        return $this->instance->__soapCall('getStudentName', $id_array);
    }


}

// $client = new Client;