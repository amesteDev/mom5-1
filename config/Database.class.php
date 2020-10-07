<?php

class Database{
    private $dsn = "mysql:host=localhost;dbname=ameste_blog";
    private $login = "ameste_blog";
    private $password = "password";
    
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