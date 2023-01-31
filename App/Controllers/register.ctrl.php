<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('../Classes/db.class.php');
include_once('../../models/register.mdl.php');
include_once('../Classes/data.class.php');

// initialisation des variables 

$name = $prenom = $dn = $ln = $acd = $dp = $niv = $mbac = $et = $cne = $cin = $tel = $email = $fl = $pwd = $pwdCf = '';

// initialisation de messages d'erreurs 
$alert = '';
$errors = array(
    'nom'=>'',
    'prenom'=>'',
    'dn'=>'',
    'ln'=>'',
    'acd'=>'',
    'dp'=>'',
    'niv'=>'',
    'mbac'=>'',
    'et'=>'',
    'cne'=>'',
    'cin'=>'',
    'tel'=>'',
    'email'=>'',
    'pwd'=>'',
    'pwdCf'=>'',
    'fl'=>'');

if(isset($_POST['submit'])){
    // nottoyage des donnes (les espaces inutiles, les balise non sécurise, les slashes)
    $name = Data::cleanData($_POST['NOM']);
    $prenom = Data::cleanData($_POST['PRENOM']);
    $dn = Data::cleanData($_POST['DN']);
    $ln = Data::cleanData($_POST['LN']);
    $acd = Data::cleanData($_POST['ACD']);
    $dp = Data::cleanData($_POST['DP']);
    $niv = Data::cleanData($_POST['NIV']);
    $mbac = Data::cleanData($_POST['MBAC']);
    $et = Data::cleanData($_POST['ET']);
    $cne = Data::cleanData($_POST['CNE']);
    $cin = Data::cleanData($_POST['CIN']);
    $tel = Data::cleanData($_POST['TEL']);
    $email = Data::cleanData($_POST['EMAIL']);
    $fl = Data::cleanData($_POST['FL']);
    $pwd = Data::cleanData($_POST['passwd']);
    $pwdCf = Data::cleanData($_POST['passwdConfirm']);

    // verification de la syntaxe des inputs 
    if(empty($name)){
        $errors['nom'] = "Entrer le nom!";
    }elseif(!preg_match('/^([a-zA-Z]{2,7}( )*){1,2}$/',$name)){
        $errors['nom'] = "invalid syntaxe";
    }
    if(empty($prenom)){
        $errors['prenom'] = "Entrer le prenom!";
    }elseif(!preg_match('/^([a-zA-Z]{2,7}( )*){1,3}$/',$prenom)){
        $errors['prenom'] = "invalid syntaxe";
    }
    if(empty($dn)){
        $errors['dn'] = "Entrer le date de naissance!";
    }elseif(!Data::valideAge($dn)){
        $errors['dn'] = "age no valide";
    }
    if(empty($ln)){
        $errors['ln'] = "Entrer le lieu de naissance!";
    }elseif(!preg_match('/^([a-zA-Z]{2,12}( )*){1,3}$/',$ln)){
        $errors['ln'] = "invalid syntaxe";
    }
    if(empty($acd)){
        $errors['acd'] = "Entrer l'accadémie!";
    }elseif(!preg_match('/^([a-zA-Z]{3,12}( )*){1,3}$/',$acd)){
        $errors['acd'] = "invalid syntaxe";
    }
    if(empty($dp)){
        $errors['dp'] = "Entrer la direction et le province!";
    }elseif(!preg_match('/^([a-zA-Z]{3,12}( )*){1,5}$/',$dp)){
        $errors['dp'] = "invalid syntaxe";
    }
    if(empty($niv)){
        $errors['niv'] = "Entrer le niveau bac!";
    }elseif(!preg_match('/^2bac science (( )*[a-zA-Z]{3,12}){1,4}$/',$niv)){
        $errors['niv'] = "invalid syntaxe";
    }
    if(empty($mbac)){
        $errors['mbac'] = "Entrer le moyenne de bac!";
    }elseif(!preg_match('/^1[0-9](\.[0-9]{1,2})?$/',$mbac)){
        $errors['mbac'] = "invalid syntaxe";
    }
    if(empty($et)){
        $errors['et'] = "Entrer le nom de l'etablissement!";
    }elseif(!preg_match('/^([a-zA-Z]{3,12}( )*){1,5}$/',$et)){
        $errors['et'] = "invalid syntaxe";
    }
    if(empty($cne)){
        $errors['cne'] = "Entrer le code massar!";
    }elseif(!preg_match('/^[A-Z][0-9]{9}$/',$cne)){
        $errors['cne'] = "invalid syntaxe";
    }
    if(empty($cin)){
        $errors['cin'] = "Entrer le numéro d'identité!";
    }elseif(!preg_match('/^[A-Z][0-9]{6,9}$/',$cin)){
        $errors['cin'] = "invalid syntaxe";
    }
    if(empty($tel)){
        $errors['tel'] = "Entrer le numéro telephone!";
    }elseif(!preg_match('/^0[67][0-9]{8}$/',$tel)){
        $errors['tel'] = "invalid syntaxe";
    }
    if(empty($email)){
        $errors['email'] = "Entrer votre email!";
    }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $errors['email'] = "invalid eamil";
    }
    if(empty($pwd)){
        $errors['pwd'] = "Entrer une mot de passe!";
        $errors['pwdCf'] = "Confirmer le mot de passe!";
    }elseif(!preg_match('/^([a-zA-Z]?[0-9]?[*$@#!%]?){4,12}$/',$pwd) || strlen($pwd) < 5){
        $errors['pwd'] = "non valide mot de passe!! ";
    }elseif($pwd != $pwdCf){
        $errors['pwdCf'] = "mot de passe non compatible!!";
    }
    if(array_filter($errors) == []){
        if(!Candidate::checkCandidate($cne)){ // tester l'existance de  candidat
            $student = array($name,$prenom,$dn,$ln,$acd,$dp,$niv,$mbac,$et,$cne,$cin,$tel,$email,$fl,$pwd);
            Candidate::addCandidate($student);// ajouter le candidat sur la bd
            $alert = "l'inscription est finis";
        }
        else{
            $alert = "vous etes deja inscrit";
        }
    }
    else{
        $alert = "les informations sont invalide";
    }
}
$_SESSION['errors'] = $errors;
$_SESSION['alert'] = $alert;
header('location:../../view/register.php');
