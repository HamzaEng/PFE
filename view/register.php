<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
@$errors = $_SESSION['errors'];
@$alert = $_SESSION['alert'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/x-icon" href="../imgaes/student.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
  <style>
    <?php include_once("../CSS/style.css"); ?>
  </style>
  <title>inscription</title>
</head>

<body>
  <!-- HEADER && NAVIGATION -->
  <?php include_once('includes/header.html');
  include_once('includes/navigation.html') ?>
  <a href="<?php include_once('../App/Controllers/home.ctrl.php');
            getPdfFile("../uploads/pdf");
            ?> " class="toConditions">voir les résultas</a>
  </div><!-- cette balise fermé est de navigation cela permet d'ignore le lien au desus pour certain pages-->
  <!-- FORMULAIRE -->
  <section class="contenair" id="main">
    <div class="form__infos">
      <h1 class="form__h1">inscription</h1>
      <p class="form__p">
        l'inscription commence de mois 6 jusqu'à le mois 9, vous pouvez voir les resultats d'annonce en cliquant sur le <b>voir les résultats</b> au dessus
      </p>
    </div>
    <form action="../App/Controllers/register.ctrl.php" method="POST" class="formulaire">
      <h1 class="formulaire__h1">
        <span class="formulaire__icon"><i class="fa-solid fa-user"></i></span>
        infos personnelles
      </h1>
      <div class="formulaire__perso">
        <div class="formulaire__item">
          <label for="Nom">Nom</label>
          <input class="admin__input" type="text" id="Nom" name="NOM" />
          <span class="formulaire__error"><?php echo @$errors['nom']; ?> </span>
        </div>
        <div class="formulaire__item">
          <label for="Prenom">Prénom</label>
          <input class="admin__input" type="text" id="Prenom" name="PRENOM" />
          <span class="formulaire__error"><?php echo @$errors['prenom']; ?> </span>
        </div>
        <div class="formulaire__item">
          <label for="DN">Date de naissance </label>
          <input class="admin__input" type="date" id="DN" name="DN" />
          <span class="formulaire__error"><?php echo @$errors['dn'] ?></span>
        </div>
        <div class="formulaire__item">
          <label for="LN">Lieu de naissance</label>
          <input class="admin__input" type="text" id="LN" name="LN" />
          <span class="formulaire__error"><?php echo @$errors['ln']; ?> </span>
        </div>
        <div class="formulaire__item">
          <label for="acd">Académie</label>
          <input class="admin__input" type="text" id="acd" name="ACD" />
          <span class="formulaire__error"><?php echo @$errors['acd']; ?> </span>
        </div>

        <div class="formulaire__item">
          <label for="DP">Direction provinciale</label>
          <input class="admin__input" type="text" id="DP" name="DP" />
          <span class="formulaire__error"><?php echo @$errors['dp']; ?> </span>
        </div>
        <div class="formulaire__item Niveau">
          <label for="NIV">Niveau</label>
          <input class="admin__input" type="text" id="NIV" name="NIV" placeholder="2bac science " />
          <span class="formulaire__error"><?php echo @$errors['niv']; ?> </span>
        </div>
        <div class="formulaire__item">
          <label for="moyBac">Moyenne de baccalauréat</label>
          <input class="admin__input" type="text" id="moyBac" name="MBAC" />
          <span class="formulaire__error"><?php echo @$errors['mbac']; ?> </span>
        </div>
        <div class="formulaire__item">
          <label for="eta">Etablissement</label>
          <input class="admin__input" type="text" id="eta" name="ET" placeholder="les chiffres ne sont pas autorise" />
          <span class="formulaire__error"><?php echo @$errors['et']; ?> </span>
        </div>
        <div class="formulaire__item">
          <label for="code">Code élève</label>
          <input class="admin__input" type="text" id="code" name="CNE" />
          <span class="formulaire__error"><?php echo @$errors['cne']; ?> </span>
        </div>
        <div class="formulaire__item">
          <label for="CIN">N° de la carte nationale d'identité
            <span style="color: red">*</span></label>
          <input class="admin__input" type="text" id="CIN" name="CIN" />
          <span class="formulaire__error"><?php echo @$errors['cin']; ?> </span>
        </div>
        <div class="formulaire__item">
          <label for="tele">Téléphone<span style="color: red">*</span></label>
          <input class="admin__input" type="tel" id="tele" name="TEL" />
          <span class="formulaire__error"><?php echo @$errors['tel']; ?> </span>
        </div>
        <div class="formulaire__item">
          <label for="email">Email<span style="color: red">*</span></label>
          <input class="admin__input" type="email" id="email" name="EMAIL" />
          <span class="formulaire__error"><?php echo @$errors['email']; ?> </span>
        </div>
        <div class="formulaire__item">
          <label for="passwd">Entrer une mot de passe:</label>
          <input class="admin__input" type="password" name="passwd" id="passwd">
          <span class="formulaire__error"><?php echo @$errors['pwd']; ?> </span>
        </div>
        <div class="formulaire__item">
          <label for="passwdConfirm">Confirmer votre mot de passe</label>
          <input class="admin__input" type="password" name="passwdConfirm" id="passwdConfirm">
          <span class="formulaire__error"><?php echo @$errors['pwdCf']; ?> </span>
        </div>
        <div class="formulaire__item">
          <label for="filière">Choisir une filière</label>
          <select id="filière" name="FL" class="prof__select prof__select1">
            <option value="Système et Réseau informatique">
              Système et Réseau informatique
            </option>
            <option value="Management Touristique">
              Management Touristique
            </option>
            <option value="Multimédias et conception WEB">
              Multimédias et conception WEB
            </option>
          </select>
        </div>
        <div class="formulaire__item">
          <mark style="color: black; width:80%"><?php echo @$alert; ?></mark>
        </div>
        <div class="formulaire__item">
         <?php if(date('m') >= 1  && date('m') < 9){?>
          <input type="submit" name="submit" value="valider">
          <?php }else{?>
          <h4 style="color: red;"> !! la dure d'inscription a expiré </h4>
          <?php }?>

        </div>
      </div>
    </form>
  </section>

  <script type="text/javascript">
    <?php include("../JS/man.js") ?>
  </script>
</body>

</html>