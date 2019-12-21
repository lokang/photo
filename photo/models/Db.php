<?php

class Db
{
    public $conn;

    public function __construct()
    {
        $servername = "localhost";
        $username = "lokang";
        $password = "laboni21";

        try {
            $this->conn = new PDO("mysql:host=$servername;dbname=photo", $username, $password);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connected successfully";
        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}