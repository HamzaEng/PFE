<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include('../Classes/db.class.php');
include('../Classes/spreadSheet.class.php');
include('../../models/prof.mdl.php');
include('../Classes/data.class.php');

// 'ajout des notes 
$fileContents = '';
$notes = '';
if(isset($_POST['uploadNotes'])){
    $fileName = $_FILES['notes']['name'];
    $fileContents = $_FILES['notes']['tmp_name'];
    $matiere = $_POST['matiere'];
    $filere = $_POST['fl'];
    $numExam = $_POST['examen'];
    $semestre = $_POST['semestre'];
    if($semestre !== "EN" && $semestre !== "EP")
        $examen = $matiere.$numExam.$semestre;
    else
        $examen = $matiere."E";
    if($fileContents == '')
        $error = "charger un fichier ";
    else{
        if(!Data::valideExtension($fileName,"csv"))
            $error = "le fichier n'est pas valide!";
        else{
            $notes = Data::cleanArray(SpreadSheet::toArray($fileContents));
            if(empty($notes))
                $error = "fichier inacceptable";
            else{
                for($index = 0; $index < count($notes) ; $index++){
                    if(Prof::addNotes($notes[$index][2], $filere, $examen, $notes[$index][3]))
                        $error = "l'insertion des donnes est reussite!";
                    else
                        $error = "l'isertion des donnes est impossible!";
                }
            }
        }
    }
    $_SESSION['noteErrors'] = $error;
}


header("location:../../view/prof.php");


?>