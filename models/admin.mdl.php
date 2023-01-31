<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Directeur{
    const username = "309cd3800aacbd003ac36199fa537295";// mohamed
    const password =  "21232f297a57a5a743894a0e4a801fc3";// admin
    static public function directeurLogin($username, $password){
        if(md5($username) == self::username && md5($password) == self::password)
            return true;
        else
            return false;
    }
    static public function getCandidats(){
        $sql = Db::connect()->prepare("SELECT * FROM STUDENTS ORDER BY FL AND MBAC");
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
            return $sql->fetchAll();
    }
    static public function addStudents($student){
        $sql = Db::connect()->prepare("INSERT INTO admis(nom,prenom,cne,cin,password,fl,ANSC) VALUES(?,?,?,?,?,?,?)");
            return $sql->execute($student);
    }
    static public function studentExists($code_massar, $filiere){
        $sql = Db::connect()->prepare("SELECT * FROM admis WHERE cne = ? AND fl = ?");
        $sql->execute(array($code_massar, $filiere));
        $tab  = $sql->fetchAll();
        if(!empty($tab)) 
            return true; // l'etudiant exists
        else
            return false; 
    }
    static public function removeStudnet($code_massar, $branche){
        return Db::connect()->exec("DELETE FROM admis WHERE cne = '$code_massar' AND fl = '$branche'");
    }
    static public function addProfs($profs){
        $sql = Db::connect()->prepare("INSERT INTO admis(nom, prenom, cin , password, M1, M2, M3, M4) VALUES(?,?,?,?,?,?,?,?)");
            return $sql->execute($profs) ; 
    }
    static public function profExists($cin){
        $sql = Db::connect()->prepare("SELECT * FROM admis WHERE cin = ?");
        $sql->execute(array($cin));
        $tab = $sql->fetchAll();
            return empty($tab) ? false : true; // true => exists 
    }
    static public function getProfs(){
        $sql = Db::connect()->prepare("SELECT nom, prenom, cin, password, M1, M2, M3, M4 FROM admis WHERE cne  IS NULL ");
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
            return $sql->fetchAll();
    }
    static public function removeProf($cin){
       return  Db::connect()->exec("DELETE FROM admis WHERE cin = '$cin'");          
    }
    static public function getNotes($filiere){
        $sql = Db::connect()->prepare("SELECT * FROM admis WHERE fl = ?");
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute(array($filiere));
            return $sql->fetchAll();
    }
    static public function getStudents($branche){
        $tab = '';
        $sql = Db::connect()->prepare('SELECT nom, prenom, cne, cin, password, ANSC FROM admis WHERE fl = ?');
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute(array($branche));
        $tab = $sql->fetchAll();
            return $tab;
    }
    static public function viderTable($tableName){
        $sql = Db::connect()->prepare("DELETE FROM $tableName");
        $sql->execute();
    }
}









?>