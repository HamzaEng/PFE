<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class SpreadSheet{
    /* cette fonction permet de transformer un tableau à un fichier excel avce une description*/
    static public function toSpread($array,$filename,$description){
        $row1 = $array[0];
        file_put_contents($filename,'');
        foreach($row1 as $title=>$v){
            $row1[$title] = $title;
        }
        $fp = fopen($filename, "r+");
        fputs($fp,$description."\n");
        fputcsv($fp,$row1,";");
        foreach($array as $row){
            fputcsv($fp,$row,";");
        }
        fclose($fp);
    }
    static public function toArray($file){
        $size = count(file($file)); 
        $fp = fopen($file,'r');
        for($index=0; $index<$size; $index++){
            $array[$index] = explode(";",fgets($fp));
        }
        fclose($fp);
        unset($array[0]); 
        $array = array_values($array); // trier la table ordonanacement 
            return $array;
    }
    static public function filterSpread($file, $matieres, $notes, $semestre){
        file_put_contents($file,'');
        if($semestre !== "examen"){
            $fp = fopen($file, "r+");
            fputs($fp,"Nom;Prenom");
            for($index = 0; $index < count($matieres); $index++){
                for($numExam = 1; $numExam < 3; $numExam++){
                  fputs($fp,";".$matieres[$index].$numExam."S".$semestre[1]);
                }
          }   
          fputs($fp, "\n");
          for($index = 0; $index < count($notes); $index++){
              $row = array($notes[$index]["nom"],$notes[$index]['prenom']);
              foreach($matieres as $mat){
                for($numExam = 1; $numExam < 3; $numExam++){
                    array_push($row,$notes[$index][$mat.$numExam."S".$semestre[1]]);
                }
              }
            fputcsv($fp,$row,";");
          } 
          fclose($fp);
        }
        else{
            $fp = fopen($file, "r+");
            fputs($fp,"Nom;Prenom");
            for($index = 0; $index < count($matieres); $index++){
                  fputs($fp,";".$matieres[$index]);
            }
            fputs($fp, "\n");
            for($index = 0; $index < count($notes); $index++){
                $row = array($notes[$index]["nom"],$notes[$index]['prenom']);
                foreach($matieres as $mat){
                    array_push($row,$notes[$index][$mat."E"]);
                }
              fputcsv($fp,$row,";");
            } 
            fclose($fp);
        }
        
    }
}




?>