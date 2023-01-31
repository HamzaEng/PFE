<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// connexion au serveur localhost 
// creation de la base de donne 

try {
    $db = new PDO("mysql:host=localhost","root","");
    $db->exec('CREATE DATABASE IF NOT EXISTS BTS');
}catch(PDOException $eror) {
    echo "Error" . $eror->getMessage();
}


// creation des tables 
// connexion a la base de donne 
include('../App/Classes/db.class.php');

// la table des candidats STUDENTS 

$statement = "CREATE TABLE IF NOT EXISTS STUDENTS(
    ID INT AUTO_INCREMENT PRIMARY KEY ,
    NOM VARCHAR(20) NOT NULL,
    PRENOM VARCHAR(20) NOT NULL,
    DN DATE NOT NULL,
    LN VARCHAR(45) NOT NULL,
    ACD VARCHAR(45) NOT NULL,
    DP VARCHAR(45) NOT NULL,
    NIV VARCHAR(45) NOT NULL,
    MBAC FLOAT(7) NOT NULL,
    ET VARCHAR(45) NOT NULL,
    CNE VARCHAR(10) NOT NULL,
    CIN VARCHAR(9) NOT NULL,
    TEL INT(10) NOT NULL,
    EMAIL VARCHAR(30) NOT NULL,
    FL VARCHAR(30) NOT NULL,
    PASSWORD VARCHAR(15) NOT NULL)";

$sql = Db::connect()->exec($statement);

// la table des admis ( profs , etudiants, matieres, notes )

$stat = "CREATE TABLE IF NOT EXISTS admis(
        id INT AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(20) NOT NULL,
        prenom VARCHAR(20) NOT NULL,
        cne VARCHAR(10),
        cin VARCHAR(9) NOT NULL,  
        password VARCHAR(15) NOT NULL,
        fl VARCHAR(12) NULL,
        ANSC INT(11) NULL,
        M1 VARCHAR(10) NULL,
        M2 VARCHAR(10) NULL,
        M3 VARCHAR(10) NULL,
        M4 VARCHAR(10) NULL
    )";
Db::connect()->exec($stat);

require '../sources/abreviations.php';

foreach($abreviations as $mat => $abre) {
    for($semestre=1;$semestre<3;$semestre++){
        for($exam=1;$exam<3;$exam++){
            Db::connect()->exec("ALTER TABLE admis ADD  IF NOT EXISTS ${mat}${exam}S${semestre} FLOAT NULL");
        }
    }
}
// pour l'examen nationale ou passage 
foreach($abreviations as $mat => $abre) {
    Db::connect()->exec("ALTER TABLE admis ADD IF NOT EXISTS ${mat}E FLOAT NULL");
}


