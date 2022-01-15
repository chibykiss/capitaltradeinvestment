<?php

class connection{
    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $database = 'bitinvest';

    public function connect(){

        try {
            $dns = 'mysql:host='.$this->host.';dbname='.$this->database;   //dsn
            $conn = new PDO($dns,$this->user,$this->pass);//main connection
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//set errmode attribute
            $conn->setAttribute(PDO:: ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            // echo 'connect success';
            return $conn;
        } catch (PDOexception $e) {
            echo 'connection faile'.$e->getMessage();
        }
       

    }
}
$try_conn = new connection;
$try_conn->connect();