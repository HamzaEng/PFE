<?php 
class Student{
    static public function studentLogin($cne, $password){
        $sql = Db::connect()->prepare("SELECT * FROM admis WHERE cne = ? AND password = ?");
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute(array($cne,$password));
            return $sql->fetchAll();     
    }
    static public function getNumberOfStudents($brancheAnne){
        $sql = Db::connect()->prepare('SELECT * FROM admis WHERE fl = ?');
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute(array($brancheAnne));
            return count($sql->fetchAll());
    }
}
?>

