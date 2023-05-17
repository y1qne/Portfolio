<?php
class db_connect
{
    public $pdo;
    function __construct()
    {
        $serveur = "localhost";
        $dbname = "commondatabase";
        $user = "root";
        $pass = "root";
        try {
            $this->pdo = new PDO("mysql:host=$serveur;dbname=$dbname", "$user", "$pass");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error connecting to the database: " . $e->getMessage();
        }
    }

}

$db = new db_connect();
