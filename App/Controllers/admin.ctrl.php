<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include('../Classes/db.class.php');
include('../../models/admin.mdl.php');
include('../Classes/spreadSheet.class.php');
include('../Classes/data.class.php');
include('../../sources/abreviations.php');

// voir les candidats 
if(isset($_POST['downloadCandidates'])){
    $students = Directeur::getCandidats();
    $file = '../../uploads/excel/Resultats.csv';
    if(!empty($students)){
        SpreadSheet::toSpread($students, $file,"resultats d'inscrption");
        downloadFile($file);
    }
}

// charger un fichier pdf sur le dossier uploads pour l'annonce des resultats d'inscription

if(isset($_POST['upload'])){
    @$filename = $_FILES['pdf']['name'];
    if(!empty($filename)){
        if(!Data::valideExtension($filename,"pdf") && !Data::valideExtension($filename,"PDF"))
            $pdfErrors = "le fichier n'est pas valide ";
        else{
            Data::deleteExtensions("../../uploads/pdf","pdf");
            Data::deleteExtensions("../../uploads/pdf","PDF");
            if(move_uploaded_file($_FILES['pdf']['tmp_name'], "../../uploads/pdf/".$_FILES['pdf']['name'])){
                $pdfErrors = "le fichier est successevement charge";
            }
        }
    }else   
        $pdfErrors = "Le fichier est vide!";
    $_SESSION['pdfErrors'] = $pdfErrors;
}

// l'ajout les etudiants admis 

if(isset($_POST['uploadStudents'])){
    @$filename = $_FILES['fileStudents']['name'];
    @$file = $_FILES['fileStudents']['tmp_name'];
    $brancheAnnee = $_POST['FL'];
    $premierAnne = str_replace('2','1',$brancheAnnee);
    $Annee = $brancheAnnee[strlen($brancheAnnee) - 1]; // pour savoir quel annee 
    $anneScolaire = date('Y');
    $excelErrors = $nom = "";
    if(!empty($filename)){
        if(!Data::valideExtension($filename,"csv") && !Data::valideExtension($filename,"CSV"))
            $excelErrors = "le fichier n'est pas valide!";
        else{
            $students = SpreadSheet::toArray($file);
            // validation des donnes ( eviter les doublons + eviter d'ajouter les etudiants de premier annee dans la deuxieme anne ( conflit entre les annes ))
            foreach($students as $student){
                $student = Data::cleanArray($student);
                $cne = $student[2]; // code massar  
                if( count($student) != 5 || !Data::valideArray($student)) //  != 5 => le nbr des colonnes doit etre 5 champs(nom, prenom, cne, cin, pas) |  !valideArray=> chaque champ ne doit pas etre vide 
                    $excelErrors = "Vous devez entrer tous les informations de l'etudiant !!";
                else{
                    if(Directeur::studentExists($cne, $brancheAnnee))                            
                        $excelErrors = "Desole l'insertion de donnees est impossible, un etudiant est deja insere";
                    elseif( $Annee == 2 && ( !Directeur::studentExists($cne,$premierAnne) ) ) // verifier l'existence de l'etudiant dans la premier annee si l'annee = 2
                        $excelErrors = "Aucune etudiant trouve dans la liste de premiere annee !!";              
                } 
            }
            // insertion des donnes 
            if( $excelErrors == ""){
                foreach($students as $student){
                    $student = Data::cleanArray($student); // pour eviter le probleme des espaces 
                    array_push($student, $brancheAnnee);
                    array_push($student, $anneScolaire);
                    if($Annee == 2)
                        $student[0] = $student[1] = $student[3] = '';
                    if(Directeur::addStudents($student))
                        $excelErrors = "l'insertion de donnes est reussite";
                }
            }
        }
    }else   
        $excelErrors = "Le fichier est vide!";
    $_SESSION['excelErrors'] = $excelErrors;
    // si l'admin fait ajouté les etudians  on doit libérer la table des candidats
    Directeur::viderTable('STUDENTS');
}

// voir les etudiants 
if(isset($_POST['voirEtudiants'])){
    $brancheAnnee = $_POST['FL'];
    $file = "../../uploads/excel/Students.csv";
    $students = Directeur::getStudents($brancheAnnee);
    if(!empty($students)){
        SpreadSheet::toSpread($students, $file,'les etudiants de la class '.$brancheAnnee);
        downloadFile($file);
    }

}


// supprimer un etudiant  

if(isset($_POST['removeStudent'])){
    $filiere = $_POST['FL'];
    $code_massar = Data::cleanData($_POST['cne']);
    if(empty($code_massar))
        $stdErrors = "Entrer le code massar de l'etudiant";
    else{
        if(Directeur::removeStudnet($code_massar, $filiere))
            $stdErrors = "L'etudiant a ete supprime successevement!";
        else
            $stdErrors = "Etudiant n'existe pas!!";
    }
    $_SESSION['stdErrors'] = $stdErrors;
}
$errors = array(
    'nom'=>'',
    'prenom'=>'',
    'cin'=>'',
    'pass'=>'',
    'pssCf'=>'',
    'message'=>''
);
$matieres = ['','','','']; // un professeur ne peut etudier que 4 matieres au maximum 
$nom = $prenom = $cin = $pass = $passConf = '';

if(isset($_POST['addProfs'])){
    $nom = Data::cleanData($_POST['profNom']);
    $prenom = Data::cleanData($_POST['profPrenom']);
    $cin = Data::cleanData($_POST['cinPf']);
    $pass = Data::cleanData($_POST['profPss']);
    $passConf = Data::cleanData($_POST['profPssConf']);
    $index = 0;

    if(empty($nom)){
        $errors['nom'] = "Entrer le nom!";
    }elseif(!preg_match('/^([a-zA-Z]{2,7}( )*){1,2}$/',$nom)){
        $errors['nom'] = "!le nom est incorrecte";
    }
    if(empty($prenom)){
        $errors['prenom'] = "Entrer le prenom!";
    }elseif(!preg_match('/^([a-zA-Z]{2,7}( )*){1,3}$/',$prenom)){
        $errors['prenom'] = "!le prenom est incoreecte";
    }
    if(empty($cin)){
        $errors['cin'] = "Entrer le numéro d'identité!";
    }elseif(!preg_match('/^[A-Z][0-9]{6,9}$/',$cin)){
        $errors['cin'] = "invalid syntaxe";
    }
    if(empty($pass)){
        $errors['pass'] = "Entrer une mot de passe!";
        $errors['passCf'] = "Confirmer le mot de passe!";
    }elseif(!preg_match('/^([a-zA-Z]?[0-9]?[*$@#!%]?){4,12}$/',$pass) || strlen($pass) < 5){
        $errors['pass'] = "non valide mot de passe!! ";
    }elseif($pass != $passConf){
        $errors['passCf'] = "mot de passe non compatible!!";
    }

    if(array_filter($errors) == []){
        foreach($abreviations as $name=>$val){
            if(isset($_POST[$name])){
                $matieres[$index] = $_POST[$name];
                $index++;
            }
        }
        if(array_filter($matieres) == [])
            $errors['message'] = "vous devez attribuer les matieres!";
        else{
            if(Directeur::profExists($cin))
                $errors['message'] = "Un professeur existe deja!!";
            else{
                if(Directeur::addProfs(array($nom, $prenom, $cin, $pass, ...$matieres)))
                    $errors['message'] = "les donnes sont inseeres successevement !";
                else
                    $errors['message'] = "Desole les donnes ne sont pas inserees!";
            }
        }
    }
           
    $_SESSION['profErrors'] = $errors; 
    echo $_POST['DEVM'];
}

// voir liste des professeurs 

if(isset($_POST['downloadProfs'])){
    $profs = Directeur::getProfs();
    $file = "../../uploads/excel/Profs.csv";
    if(!empty($profs)){
        SpreadSheet::toSpread($profs,$file ,"Liste des professeur Bts");
        downloadFile($file);
    }else
        echo "there is a error ";
}

// suppression d'un professeur 

if(isset($_POST['removePf'])){
    $cin = Data::cleanData($_POST['cin']);
    if(empty($cin))
        $removePf = "Saisi l'identifiant CIN";
    else{
        if(!empty(Directeur::removeProf($cin)))
            $removePf = "la suppression est succes!";
        else
            $removePf = "la suppression est echoue!";
    } 
    $_SESSION['removePf'] = $removePf;
}


// voir les notes des etudiants 

// les matiers de chque filiere et annee  
$SRI = array("ARAB","FRAN","ENGL","MATH","COMM","SYST","RESE","DEVE","LINU");
$SRI1 = array(...$SRI,"ARCH","ECON");
$SRI2 = array(...$SRI,"SECU");



if(isset($_POST['downloadNotes'])){
    $filiere = $_POST['fl'];
    $semestre = $_POST['semestre'];
    $file = "../../uploads/excel/Notes.csv";
    $notes = Directeur::getNotes($filiere);
    if($filiere == "SRI1")
        $table = $SRI1;
    else
        $table = $SRI2;
    if(!empty($notes)) {
        SpreadSheet::filterSpread($file, $table, $notes, $semestre);
        downloadFile($file);
    }
}


function downloadFile($file) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit();
}

header("location:../../view/admin.php");
