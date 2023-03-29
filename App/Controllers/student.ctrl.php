<?php
session_start();
include_once('../../sources/Matieres.php');
$student = $_SESSION['student'];
$year = 0;
$sem = 0;

function sumCoffecients($matieres)
{ // => get sum of coffs of any branche;
    $total = 0;
    foreach ($matieres as $coff) {
        $total = $total + $coff;
    }
    return $total;
}

function getMoyenneExam($matieres, $annee, $student)
{ // => get moyenne of examen 
    $total = 0;
    $sumCoffs = sumCoffecients($matieres);
    foreach ($matieres as $matiere => $coffecient) {
        if (!isset($student[$annee][$matiere . "E"]))
            return;
        else
            $total += $student[$annee][$matiere . "E"] * $coffecient;
    }
    $MoyenneExamen = $total / $sumCoffs;
    return $MoyenneExamen;
}

function getMoyenneOfmatieres($anee, $matieres, $student)
{ // => get moyenne  of chaque matieres hhh
    foreach ($matieres as $mat => $coff) {
        $total = 0;
        for ($sem = 1; $sem <= 2; $sem++) {
            for ($exam = 1; $exam <= 2; $exam++) {
                if (!isset($student[$anee][$mat . $exam . "S" . $sem]))
                    return;
                else
                    $total += $student[$anee][$mat . $exam . "S" . $sem];
            }
        }
        $note[$mat] = $total / 4; // moyenne  
    }
    return $note;
}

function getMoyenneOfSemestre($matieres, $annee, $semestre, $student)
{ //=> get moyenne of semestre 
    $sumCoffs = sumCoffecients($matieres);
    $total = 0;
    foreach ($matieres as $mat => $coff) {
        $sum = 0;
        for ($exam = 1; $exam <= 2; $exam++) {
            if (!isset($student[$annee][$mat . $exam . "S" . $semestre]))
                return;
            $sum += $student[$annee][$mat . $exam . "S" . $semestre];
        }
        $total += ($sum / 2) * $coff;
    }
    return $total / $sumCoffs;
}


if (isset($_POST['search'])) {
    //initialisation 
    $anne = $_POST['anne'];
    $semestre = $_POST['semestre'];
    // get year 
    if ($anne == "anne1")
        $year = 0;
    else
        $year = 1;
    // get semstre
    if ($semestre == "s2")
        $sem = 2;
    elseif ($semestre == "s1")
        $sem = 1;
    else
        $sem = "MoyenneGenerale";
}

switch ($student[$year]['fl']) {
    case 'SRI1':
        $matieres = $Sri1Coffs;
        break;
    case 'SRI2':
        $matieres = $Sri2Coffs;
        break;
    case 'MT1':
        $matieres = $Mt1Coffs;
        break;
    case 'MT2':
        $matieres = $Mt1Coffs;
        break;
    case 'MCW1':
        $matieres = $Mcw1Coffs;
        break;
    case 'MCW2':
        $matieres = $Mcw2Coffs;
        break;
}

print_r($matieres);

$_SESSION['year'] = $year;
$_SESSION['sem'] = $sem;
$_SESSION['moyenneExam'] = getMoyenneExam($matieres, $year, $student);
$_SESSION['NOTES'] = getMoyenneOfmatieres($year, $matieres, $student);
$_SESSION['sem1'] = getMoyenneOfSemestre($matieres, $year, 1, $student);
$_SESSION['sem2'] = getMoyenneOfSemestre($matieres, $year, 2, $student);


header("location:../../view/student.php");
