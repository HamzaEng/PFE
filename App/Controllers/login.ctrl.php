<?php
session_start();

require('../Classes/db.class.php');
require('../../models/student.mdl.php');
require('../../models/prof.mdl.php');
require('../../models/admin.mdl.php');
require('../Classes/data.class.php');


// initialisation de variables de l'error

$errors = array(
    'username'=>'',
    'password'=>'',
    'message'=>''
);

if(isset($_POST['login'])){
    // nettoyage de donnes
    $username = Data::cleanData($_POST['username']);
    $password = Data::cleanData( $_POST['password']);
    if(empty($username))
        $errors['username'] = "Entrer votre username";
    if(empty($password))
        $errors['password']= "Entrer votre mot de passe !";

    if(array_filter($errors) == []){
          $arrs = Student::studentLogin($username,$password);// $arrs array Student tableau de l'etudiant contient ses infos 
          $arrp = Prof::profLogin($username,$password);// $arrp array Professeur
        //admin login 
        if(Directeur::directeurLogin($username,$password)){// fonction retourn boolen 
            $_SESSION['adminValide'] = 'oui';
            header("location:../../view/admin");
            exit();
        }
        //etudiant login 
        elseif(!empty($arrs)){
            $_SESSION['studentValide'] = "oui";
            $_SESSION['student'] = $arrs;
            header("location:../../view/student");
            exit();
        }
        // professeur login 
        elseif(!empty($arrp)){
            $_SESSION['profValide'] = "oui";
            $_SESSION['prof'] = $arrp;
            header("location:../../view/prof");
            exit();
        }
            else{
               $errors['message']= "informations non valide !";
            }
    }
    $_SESSION['loginErrors'] = $errors;
    header("location:../../view/login");
}





?>
