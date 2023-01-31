<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class Prof{
    static public function profLogin($cin, $password){
        $sql = Db::connect()->prepare("SELECT * FROM admis WHERE cin = ? AND password = ?");
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute(array($cin,$password));
        return $sql->fetchAll();     
    }
    static public function addNotes($code_massar, $brancheAnne, $examen ,$note){
        $sql = Db::connect()->prepare("UPDATE admis SET $examen = ? WHERE cne = ? AND fl = ?");
            return $sql->execute(array($note, $code_massar, $brancheAnne));
    }
}

?>