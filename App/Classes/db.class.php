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
 
/* class Db{
    private $server;
    private $db;
    private $user;
    private $password;
    public function __construct()
    {
        $this->server = "localhost";
        $this->db = "BTS";
        $this->user = "root";
        $this->password = "";
    }
    static public function connect(){
        try {
            $database = new Db();
            $pdo = new PDO("mysql:host=".$database->server.";dbname=".$database->db,$database->user,$database->password);
            $pdo->exec("set names utf8");
            return $pdo;
        }catch(PDOException $error) {
            die("Error ".$error->getMessage());
        }

    }
}
 */