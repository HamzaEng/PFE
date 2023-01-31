<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/x-icon" href="../imgaes/student.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
  <style>
    <?php include_once('../CSS/style.css') ?>
  </style>
  <title>Bts Essaouira</title>
</head>

<body>
  <!-- NAVIGATION && HEADER -->
  <?php include_once('includes/header.html');
  include_once('includes/navigation.html') ?>
  <a href="<?php include_once('../App/Controllers/home.ctrl.php');
            getPdfFile("../uploads/pdf");
            ?> " class="toConditions">voir les résultas</a>
  </div><!-- cette balise fermé est de navigation cela permet d'ignore le lien au desus pour certain pages-->
  <!-- HOME -->
  <aside class="home" id="main">
    <h1 class="home__h1">Bienvenue dans notre établissement</h1>
    <div class="formation">
      <h2 class="home__h2">Formation</h2>
      <p class="home__p">
        Le brevet de technicien supérieur se prépare en section de technicien
        supérieur dans un lycée. Cette formation accessible après le
        baccalauréat ou équivalent dispense des enseignements spécialisés.
        Elle est accompagnée d'un ou de plusieurs stages en entreprise. Elle
        permet d'obtenir un diplôme professionnalisé en
        <mark> deux ans. </mark>
      </p>
    </div>
  </aside>
  <aside class="conditions">
    <a href="#nav" id="top" title="back to">
      <div id="toTop"></div>
    </a>
    <h1 class="conditions__h1">Les conditions d'accès</h1>
    <p class="conditions__p">
      Le Bts Essaouira est une branche qui vous préparez soit d’intégrer
      directement le domaine professionnel et renforcer vos acquis
      théoriques par la pratique,soit de poursuivre vos études en intégrant
      directement le niveau de Licence. Une seule session est organisée à la
      fin des deux années de formation pour l’obtention du B.T.S.
    <p id="more">
      Les
      candidats à cet examen sont les étudiants de la 2ème année de formation
      inscrits dans les établissements publics et privés. elle présente trois
      filière principales, qui sont des filières technique qui concerent tous
      les étudiants ayant un bac scientifique ou technique. pour plus des
      détails sur les filières
      <a href="../about" class="lien">Cliquez ici</a>
    </p>
    <button id="readMore"><div class="readMore__icon"></div></button>
    </p>
    <h2 class="conditions__h2" id="conditions">conditions d'inscription</h2>
    <ul class="conditions__ul">
      <li>
        Être titulaire du baccalauréat en fonction de la filière demandée, ou
        d'un diplôme équivalent;
      </li>
      <li>Être âgé de 23 ans au plus 30 septembre de l'année en cours;</li>
      <li>
        La sélection se fait d'après la moyenne générale obtenue au
        bacclauréat;
      </li>
    </ul>
  </aside>


  <script type="text/javascript">
    <?php include("../JS/home.js") ?>
  </script>
  <script type="text/javascript">
    <?php include("../JS/man.js") ?>
  </script>
</body>

</html>