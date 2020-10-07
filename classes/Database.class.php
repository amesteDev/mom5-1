<?php

class Database{

//this uses constants that are defined in a file called dbconf.php
	private $dsn = "mysql:host=localhost;dbname=ameste_apimom5";
    private $login = "ameste_apimom5";
    private $password = "password";
    //sets up the connection to the database
    protected function connect(){
        try {
            $pdo = new PDO($this->dsn, $this->login, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            return $pdo;
        } catch (Exception $e) {
            throw $e;
            throw new PDOException("Could not connect to database, hiding details.");
        }
    }
}