<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if ($_SESSION['adminValide'] != "oui") {
    header("location:login.php");
    exit();
}

include_once('../App/Classes/data.class.php');
@$pdfErrors = $_SESSION['pdfErrors'];
@$excelErrors = $_SESSION['excelErrors'];
@$stdErrors = $_SESSION['stdErrors'];
@$profErrors = $_SESSION['profErrors'];
@$removePf = $_SESSION['removePf'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/x-icon" href="../imgaes/student.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <title>adminstration</title>
    <style>
        <?php include_once '../CSS/style.css'; ?>
    </style>
</head>

<body>
    <?php
    include_once('includes/header.html');
    include_once('includes/navigation.html');
    ?>
    <a href="deconexion.php" class="toConditions">Déconexion</a>
    </div><!-- cette balise fermé est de navigation cela permet d'ignore le lien au desus pour certain pages-->
    <!-- HOME -->
    <section class="admin" id="main">
        <h3 class="admin__h1"><?php Data::hello('Mohamed'); ?> Dans votre espace prive</h3>
        <form action="../App/Controllers/admin.ctrl.php" method="POST" class="admin__form" enctype="multipart/form-data">
            <div class="admin__item">
                <h4 class="admin__h4">pour voir les candidats veuillez cliquer sur </h4>
                <button name="downloadCandidates" type="submit" class="download__img"><img src="../imgaes/download.png" alt=""></button>
            </div>
            <h4 class="admin__h4">vous pouvez annoncer les étudiants par un ficher pdf</h4>
            <div class="admin__item">
                <input class="admin__input" type="file" name="pdf">
                <input class="admin__input" type="submit" name="upload" value="charger">
            </div>
            <span class="formulaire__error"><?php echo @$pdfErrors; ?></span>
            <h4 class="admin__h4">
                <figure class="admin__icon"> <img src="../imgaes/etudiant.png" alt=""></figure> Sélectionner une filière pour ajouter ou voir les etudiants
            </h4>
            <div class="admin__item">
                <select class="prof__select" name="FL">
                    <option value="SRI1">Système et réseau informatique 1 anne</option>
                    <option value="SRI2">Système et réseau informatique 2 anne</option>
                    <option value="MT1">Management et touristique 1 anne</option>
                    <option value="MT2">Management et touristique 2 anne</option>
                    <option value="MCW1">Multimédia et conception Web 1 anne</option>
                    <option value="MCW2">Multimédia et conception Web 2 anne</option>
                </select>
                <!-- VOIR LES INFOS DES ETUDIANTS -->
            </div>
            <div class="admin__item">
                <input class="admin__input" type="file" name="fileStudents">
                <input class="admin__input" type="submit" name="uploadStudents" value="charger"><br>
            </div>
                <input type="submit" value="voir les etudiants" name="voirEtudiants">
            <span class="formulaire__error"><?php echo @$excelErrors; ?></span><br>
            <p>!Attention le fichier doit contenir repectevement: le nom, prenom, code massar, cin, mot de passe ces titres sont obligatioire</p>
            <h4 class="admin__h4">Pour la suppression d'un eleve il faut determiner son filiere en haut sur la select </h4>
            <div class="admin__item">
                <input class="admin__input" type="text" name="cne" placeholder="Code massar de l'etudiant">
                <input class="admin__input" type="submit" name="removeStudent" value="supprimer">
            </div>
            <span class="formulaire__error"><?php echo @$stdErrors; ?></span>
            <h4 class="admin__h4">
                <figure class="admin__icon"> <img src="../imgaes/professeur.png" alt=""></figure> ajouter les professeurs
            </h4><br>
            <div class="formulaire">
                <div class="formulaire__perso">
                    <div class="formulaire__item">
                        <h5>Nom :</h5>
                        <input type="text" name="profNom">
                        <span class="formulaire__error"> <?php echo @$profErrors['nom'] ?></span>
                    </div>
                    <div class="formulaire__item">
                        <h5>Prenom :</h5>
                        <input type="text" name="profPrenom">
                        <span class="formulaire__error"> <?php echo @$profErrors['prenom'] ?></span>
                    </div>
                    <div class="formulaire__item">
                        <h5>CIN : </h5>
                        <input type="text" name="cinPf">
                        <span class="formulaire__error"> <?php echo @$profErrors['cin'] ?></span>
                    </div>
                    <div class="formulaire__item">
                        <h5>Mot de passe :</h5>
                        <input type="password" name="profPss">
                        <span class="formulaire__error"> <?php echo @$profErrors['pass'] ?></span>
                    </div>
                    <div class="formulaire__item cfpasswd">
                        <h5>Confirmation de mot de passe :</h5>
                        <input type="password" name="profPssConf">
                        <span class="formulaire__error"> <?php echo @$profErrors['passCf'] ?></span>
                    </div>
                    <div class="formulaire__item">
                        <h5> Ajouter les Matieres</h5>
                        <select name="matieres" id="matieres" class="prof__select prof__select1">
                            <option value="Secondaires">Secondaires</option>
                            <option value="Techniques" >Techniques</option>
                        </select>
                        <?php include_once('includes/techniques.php');
                        include_once('includes/secondaires.html');
                        ?>
                    </div>
                    <div class="formulaire__item">
                        <input type="submit" name="addProfs" value="ajouter">
                        <h5 style="color: red;"><?php echo @$profErrors['message'] ?></h5>
                    </div>
                </div>
                <h4 class="admin__h4">Entrer le numéro de la carte nationale de professeur</h4>
                <div class="admin__item">
                    <input class="admin__input" type="text" name="cin" placeholder="saisi le cin ">
                    <input class="admin__input" type="submit" name="removePf" value="supprimer">
                </div>
                <h5 style="color: red;"><?php echo @$removePf; ?></h5>
                <div class="formulaire__item">
                    <h4 class="admin__h4">Vous pouvez telecharger les notes de chaque classe, Veuillez selectionez une filiere et la semestre convenable</h4>
                    <select class="prof__select" name="fl">
                        <option value="SRI1">Système et réseau informatique 1 anne</option>
                        <option value="SRI2">Système et réseau informatique 2 anne</option>
                        <option value="MT1">Management et touristique 1 anne</option>
                        <option value="MT2">Management et touristique 2 anne</option>
                        <option value="MCW1">Multimédia et conception Web 1 anne</option>
                        <option value="MCW2">Multimédia et conception Web 2 anne</option>
                    </select>
                    <select name="semestre" class="prof__select">
                        <option value="S1">Semestre 1</option>
                        <option value="S2">Semestre 2</option>
                        <option value="examen">Examen Nat/Pass</option>
                    </select>
                </div>
                <div class="formulaire__item endForm">
                    <button class="admin__button" type="submit" name="downloadNotes">Télecharge le fichier</button>
                    <div>
                        <h5 class="box">Voir les inforamations des professeurs:</h5>
                        <input type="submit" name="downloadProfs" value="telecharger">
                    </div>
                </div>
            </div>

        </form>

    </section>
    <script type="text/javascript">
        <?php include("../JS/admin.js") ?>
    </script>
    <script type="text/javascript">
        <?php include("../JS/man.js") ?>
    </script>
</body>

</html>