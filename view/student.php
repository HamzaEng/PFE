<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if ($_SESSION['studentValide'] != 'oui') {
  header('location:login.php');
  exit();
}

include('../App/Classes/data.class.php');
include('../sources/Matieres.php');
include('../sources/abreviations.php');
include('../App/Classes/db.class.php');
include('../models/student.mdl.php');

$student = $_SESSION['student'];
@$year = $_SESSION['year'];
@$sem = $_SESSION['sem'];
@$moyExam = $_SESSION['moyenneExam'];
@$note = $_SESSION['NOTES'];
@$sem1 = $_SESSION['sem1'];
@$sem2 = $_SESSION['sem2'];
$branche = $student[0]['fl'];

if (empty($year) && empty($sem)) {
  $year = 0;
  $sem = 1;
}

// verification de la filiere pour savoir le tableau à utiliser 
if ($branche == 'SRI1') {
  $table = $SRI;
  $table1 = $SRI1;
} elseif ($branche == 'MT1') { // $MT et $MCW  ne sont pas defines 
  $table = $MT;
  $table1 = $MT1;
  $table2 = $MT2;
} else {
  $table = $MCW;
  $table1 = $MCW1;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/x-icon" href="../imgaes/student.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
  <title>Etudiant</title>
  <style>
    <?php include_once '../CSS/style.css'; ?>
  </style>
  <?php include('includes/header.html');
  include('includes/navigation.html');
  ?>
  <a href="deconexion.php" class="toConditions">Déconexion</a>
  </div>
  <section class="etudiant" id="main">
    <h1 class="admin__h1"><?php Data::hello($student[0]['nom']); ?> sur votre espace prive</h1>
    <div class="etudiant__infos">
      <figure class="etudiant__icon"> <img src="../imgaes/student.png" alt=""></figure>
      <div class="etudiant__text">
        <h4 class="etudiant__h4">Nom: <small><?php echo $student[0]['nom'] ?></small></h4>
        <h4 class="etudiant__h4">Prenom: <small> <?php echo $student[0]['prenom'] ?></small></h4>
        <h4 class="etudiant__h4">Filière: <small><?php echo Data::getAbreviate($student[$year]['fl'], $branchesAnne) ?></small></h4>
        <h4 class="etudiant__h4">L'année scolaire: <small><?php echo (date("Y") + 1)."-" . date("Y"); ?></small></h4>
        <h4 class="etudiant__h4">Nombre des etudiants: <small><?php echo Student::getNumberOfStudents($branche); ?></small> </h4>
      </div>
    </div>
    <form action="../App/Controllers/student.ctrl.php" method="POST">
      <div class="formulaire__item">
        <select name="anne" class="prof__select">
          <option value="anne1"><?php echo $student[0]['ANSC'] . "/" . ($student[0]['ANSC'] + 1) ?></option>
          <?php if (isset($student[1]['ANSC'])) { ?>
            <option value="anne2"> <?php echo ($student[1]['ANSC'] + 1) . "/" . ($student[1]['ANSC'] + 2);} ?>
            </option>
        </select>
        <select name="semestre" class="prof__select">
          <option value="s1">semestre 1</option>
          <option value="s2">semestre 2</option>
          <option value="MG">moyenne générale</option>
        </select>
      </div>
      <button type="submit" name="search" class="search__btn">
        <figure><img src="../imgaes/search.png" alt=""></figure>
      </button>
      <div class="etudiant__table">
        <table>
          <?php if ($sem != 'MoyenneGenerale') { // le cas de semestre ( 1 / 2 ) 
          ?>
            <tr>
              <th>Matière</th>
              <th>Examen 1</th>
              <th>Examen 2</th>
            </tr>
            <!-- les matiers communes / secondaires  -->
            <?php foreach ($commun as $mat => $cof) { ?>
              <tr>
                <td><?php echo Data::getAbreviate($mat, $abreviations); ?></td>
                <td><?php echo $student[$year][$mat . '1S' . $sem]; ?></td>
                <td><?php echo $student[$year][$mat . '2S' . $sem]; ?></td>
              </tr>
            <?php } ?>
            <!-- les matiers technques/special/varians-->
            <?php foreach ($table as $mat => $cf) { ?>
              <tr>
                <td><?php echo Data::getAbreviate($mat, $abreviations); ?></td>
                <td><?php echo @$student[$year][$mat . '1S' . $sem]; ?></td>
                <td><?php echo @$student[$year][$mat . '2S' . $sem]; ?></td>
              </tr>
              <?php }
            if ((@$student[$year]['fl'][3] == 2 || @$student[$year]['fl'][2] == 2) && !empty($table2)) { // Annee 2 ( EXception de la matiere MT contient 2 lettre)
              foreach ($table2 as $mat => $cf) { ?>
                <tr>
                  <td><?php echo Data::getAbreviate($mat, $abreviations); ?></td>
                  <td><?php echo @$student[$year][$mat . '1S' . $sem]; ?></td>
                  <td><?php echo @$student[$year][$mat . '2S' . $sem]; ?></td>
                </tr>
              <?php }
            } elseif (@$student[$year]['fl'][3] == 1 || @$student[$year]['fl'][2] == 1) { // Annne 1
              foreach ($table1 as $mat => $cf) { ?>
                <tr>
                  <td><?php echo Data::getAbreviate($mat, $abreviations); ?></td>
                  <td><?php echo @$student[$year][$mat . '1S' . $sem]; ?></td>
                  <td><?php echo @$student[$year][$mat . '2S' . $sem]; ?></td>
                </tr>
            <?php }
            } ?>


          <?php } else {/* bloc ferme pour le cas de semestre (1/2)*/ ?>
            <tr>
              <th>Matière</th>
              <th>Moyenne</th>
              <th>Note Examen</th>
            </tr>
            <!-- les matiers communes / secondaires  -->
            <?php foreach ($commun as $mat => $cof) { ?>
              <tr>
                <td><?php echo Data::getAbreviate($mat, $abreviations); ?></td>
                <td><?php Data::formater(@$note[$mat]); ?></td>
                <td><?php echo @$student[$year][$mat . "E"]; ?></td>
              </tr>
            <?php } ?>
            <!-- les matiers technques/special/varians-->
            <?php foreach ($table as $mat => $cf) { ?>
              <tr>
                <td><?php echo Data::getAbreviate($mat, $abreviations); ?></td>
                <td><?php Data::formater(@$note[$mat]); ?></td>
                <td><?php echo @$student[$year][$mat . "E"] ?></td>
              </tr>
              <?php }
            if ((@$student[$year]['fl'][3] == 2 || @$student[$year]['fl'][2] == 2) && !empty($table2)) { // Annee 2 
              foreach ($table2 as $mat => $cf) { ?>
                <tr>
                  <td><?php echo Data::getAbreviate($mat, $abreviations); ?></td>
                  <td><?php Data::formater(@$note[$mat]); ?></td>
                  <td><?php echo @$student[$year][$mat . "E"] ?></td>
                </tr>
              <?php }
            } elseif (@$student[$year]['fl'][3] == 1 || @$student[$year]['fl'][2] == 1) { // Annne 1
              foreach ($table1 as $mat => $cf) { ?>
                <tr>
                  <td><?php echo Data::getAbreviate($mat, $abreviations); ?></td>
                  <td><?php Data::formater(@$note[$mat]); ?></td>
                  <td><?php echo @$student[$year][$mat . "E"] ?></td>
                </tr>
            <?php }
            } ?>

            <table class="etudiant__moy">
              <tr>
                <th>Moyenne semestre 1</th>
                <td><?php Data::formater(@$sem1) ?></td>
              </tr>
              <tr>
                <th>Moyenne semestre 2</th>
                <td><?php Data::formater(@$sem2) ?></td>
              </tr>
              <tr>
                <th>Moyenne d'examen</th>
                <td><?php Data::formater(@$moyExam) ?></td>
              </tr>
              <tr>
                <th>Moyenne génerale</th>
                <td><?php

                    ?></td>
              </tr>
            </table>
        </table>

      <?php } // bloc ferme pour le cas de moyenne generale 
      ?>

      </div>
    </form>

  </section>


  <script type="text/javascript">
    <?php include('../JS/man.js') ?>
  </script>
  </body>

</html>
