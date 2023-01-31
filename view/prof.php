<?php
session_start();
if ($_SESSION['profValide'] != "oui") {
    header('location:login.php');
}

include('../sources/abreviations.php');
include('../App/Classes/data.class.php');
$prof = $_SESSION['prof'];
@$error = $_SESSION['noteErrors'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/x-icon" href="../imgaes/student.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <title>Professeur</title>
    <style>
        <?php include_once '../CSS/style.css'; ?>
    </style>
</head>

<body>
    <!-- HEADER && NAVIGATION -->
    <?php include_once('includes/header.html');
    include_once('includes/navigation.html');
    ?>
      <a href="deconexion.php" class="toConditions">Déconexion</a>
    </div><!-- closing tag of navigation -->

    <section class="prof" class="prof" id="main">
        <h1 class="admin__h4 admin__h1">
            <figure class="prof__icon"> <img src="../imgaes/professeur.png" alt=""></figure> <?php Data::hello($prof[0]['prenom']); ?> sur votre espace prive
        </h1>
        <p class="prof__p">Vous pouvez ajouter les notes ou les modifier à partir de meme clique sur <q>charger</q></p><br>
        <form action="../App/Controllers/prof.ctrl.php" enctype="multipart/form-data" method="POST" class="prof__form">
            <div class="prof__item">
                <select class="prof__select" name="matiere">
                    <?php for ($i = 0; $i < 4; $i++) {
                        if ($prof[0]["M" . $i] != NULL) {
                    ?>
                            <option value="<?php echo $prof[0]["M" . $i] ?>"><?php echo Data::getAbreviate($prof[0]["M" . $i], $abreviations); ?></option>
                    <?php }
                    } ?>
                </select>
                <select class="prof__select" name="semestre" id="semestre">
                    <option value="S1">semestre 1</option>
                    <option value="S2">semestre 2</option>
                    <option value="EN">Examen Nationale</option>
                    <option value="EP">Examen de Passage</option>
                </select>
            </div>
            <div class="prof__item">
                <select class="prof__select" name="examen">
                    <option value="1">Examen 1</option>
                    <option value="2">Examen 2</option>
                </select>
                <select class="prof__select" name="fl" id="fl">
                    <option value="SRI1">SRI 1</option>
                    <option value="MT1">MT 1</option>
                    <option value="MCW1">MCW 1</option>
                    <option value="SRI2">SRI 2</option>
                    <option value="MT2">MT 2</option>
                    <option value="MCW2">MCW 2</option>
                </select>
            </div>
            <div class="prof__item">
                <input class="prof__input" type="file" name="notes">
                <input type="submit" name="uploadNotes" value="ajouter" class="prof__input"><br>
                <span class="prof__message"><?php echo @$error; ?></span>
            </div>
        </form>
    </section>

    <script type="text/javascript"><?php include("../JS/prof.js") ?></script>
    <script type="text/javascript"><?php include("../JS/man.js") ?></script>
</body>

</html>