<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Candidate{
    static public function checkCandidate($code_massar){
        $sql = Db::connect()->prepare("SELECT * FROM STUDENTS WHERE CNE = ?");
        $sql->execute(array($code_massar));
        $tab = $sql->fetchAll();
        if(empty($tab))
            return false;
        else    
            return true;
    }
    static public function addCandidate($student){
        $sql = Db::connect()->prepare("INSERT INTO STUDENTS(NOM,PRENOM,DN,LN,ACD,DP,NIV,MBAC,ET,CNE,CIN,TEL,EMAIL,FL,PASSWORD) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $sql->execute($student);  

    }
}



?>