<?php

class Db
{
    const server = "localhost";
    const db = "BTS";
    const user = "root";
    const password = "";
    static public function connect()
    {
        try {
            $pdo = new PDO("mysql:host=" . self::server . ";dbname=" . self::db, self::user, self::password);
            $pdo->exec("set names utf8");
            return $pdo;
        } catch (PDOException $error) {
            die("Error " . $error->getMessage());
        }
    }
} 
 
