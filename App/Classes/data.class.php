<?php 

class Data{
    static public function cleanData($data){
        $data = htmlspecialchars($data);
        $data = trim($data);
        $data = stripslashes($data);
        $data = strip_tags($data);
            return $data;
    }
    static public function valideAge($date_naissance){
        $anneActuel = date('Y');
        $anneNaissance = date('Y',strtotime($date_naissance));
        $age = $anneActuel - $anneNaissance;
        if($age>23 || $age<17)
            return false;
        else
            return true;
    }
    static public function hello($name){
        $hour = date("H");    
        if ($hour <= 12)
            $var = "Bonjour, ";
        else
            $var = "Bonsoire, ";
        echo $var."Mr/Ms ".$name;
    }
    static public function valideExtension($filename,$extension){ 
        $tab = explode(".",$filename);
        $ext = end($tab);
        if($ext != $extension)
            return false;
        else
            return true;
    }
    static public function deleteExtensions($folder, $extension){
        $files = glob($folder."/*.".$extension);
        if(!empty($files)){
            foreach($files as $file){
                unlink($file);
            }
            return true;
        }else   
            return false;
    }
    static public function cleanArray($table){
        foreach($table as $element){
            if(is_string($element))
                $newArray[] = trim($element);
            else
                $newArray[] = $element;
        }
            return $newArray;
    }
    static public function getAbreviate($abreviateName, $names){
        return $names[$abreviateName];
    }
    static public function formater($moyenne){ // => instead of printing 00.00 we want it just empty 
        if(!isset($moyenne))
            echo ' ';
        else
            printf("%.2f",$moyenne);
    }
    static public function valideArray($array){
        foreach($array as $element){
            if($element == '')
                return false;
        }
        return true;
    }
}




?>