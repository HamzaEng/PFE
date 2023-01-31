<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/x-icon" href="../imgaes/student.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
  <style>
    <?php include_once '../CSS/style.css' ?>
  </style>
  <title>Presentation</title>
</head>

<body>
  <!-- HEADER && NAVIGATION -->

  <?php include('includes/header.html');
  include('includes/navigation.html')
  ?>
  </div>

  <!-- ABOUT -->
  <section class="about" id="main">
    <a href="#nav" id="top" title="back to">
      <div id="toTop"></div>
    </a>
    <div class="cards">
      <div class="card">
        <h2 class="about__h1"> <span id="sentence"></span><span class="pipeline">|</span></h2>
      </div>
      <div class="card">
        <figure class="about__figure hidden">
          <img src="../imgaes/Network.jpeg" />
        </figure>
        <h2 class="about__h2 hidden ">Systèmes et Réseaux informatique</h2>
        <p class="about__p hidden">
        Le Brevet de technicien supérieur vient réunir la théorie et la pratique c’est-à-dire l’enseignement général et l’enseignement technique. La formation lui permet donc l’installation et l’administration de l’environnement réseau, la configuration et l’exploitation des postes de travail et des serveurs, la mise en œuvre de plusieurs politiques protégeant les réseaux ainsi que les données de l’entreprise, la détermination des dysfonctionnements des systèmes et réseaux informatiques, la manipulation des outillages, la gestion des bases de données et encourt l’assurance du support clientèle consommateur du réseau, pour plus de details 
          <a href="https://www.men.gov.ma/Ar/Documents/SYSTEMES_RESEAUX_INFORMATIQUES.pdf">Clique ici</a>
        </p>
      </div>
      <div class="card">
        <figure class="about__figure element hidden">
          <img src="../imgaes/mang3.jpg" />
        </figure>
        <h2 class="about__h2  hidden">Management Touristique</h2>
        <p class="about__p  hidden">
        Le BTS Tourisme vise à former des professionnels aptes à informer et conseillers les clients français et étrangers au sujet de prestations touristiques. Leur rôle sera de créer et promouvoir des produits touristiques, de les vendre et d’en assurer le suivi commercial, d’accueillir et d’accompagner les touristes, mais également de collecter, traiter et diffuser l’information en lien avec le secteur du tourisme. Les diplômés posséderont de solides connaissances des métiers du tourisme, ainsi qu’une maîtrise des langues étrangères, indispensable pour exercer dans ce corps de métier. Ils pourront exercer leurs fonctions dans une entreprise de tourisme, un organisme de tourisme territorial liée à une institution locale régionale voire nationale (office de tourisme, comité départementale ou régionale de tourisme…), une entreprise de transport de personnes, ou encore une entreprise d’hébergement.
        plus des détails:           <a href="https://www.men.gov.ma/Ar/Documents/MANAGEMENT_TOURISTIQUE.pdf">Clique ici</a>
        </p>
      </div>
      <div class="card">
        <figure class="about__figure hidden">
          <img src="../imgaes/media.png" />
        </figure>
        <h2 class="about__h2 hidden">Multimédias et conception WEB</h2>
        <p class="about__p hidden">
        Le technicien supérieur en multimédia et conception web est chargé de la conception graphique et visuelle, de la participation aux développement d’applications multimédia ainsi que de la création et de l’optimisation de sites web statiques et dynamiques à partir d’une commande initiale pour laquelle sont précisés les besoins et les contraintes.
        plus des  détails : 
        <a href="https://www.men.gov.ma/Ar/Documents/MULTIMEDIA_CONCEPTION_WEB.pdf">clique ici</a>
        </p>
      </div>
    </div>
  </section>
  <script type="text/javascript">
    <?php include('../JS/about.js') ?>
  </script>
  <script type="text/javascript">
    <?php include('../JS/man.js') ?>
  </script>
</body>

</html>