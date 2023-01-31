<?php
// LES COFFECIENTS DE CHAQUE FILIERE 

$commun = array(
  'ARAB' => 10,
  'FRAN' => 10,
  'ENGL' => 10,
  'COMM' => 10
);

$SRI = array(
  'SYST' => 30,
  'RESE' => 30,
  'DEVE' => 15,
  'LINU' => 20,
  'MATH' => 15
);

$SRI1 = array(
  'ARCH' => 20,
  'ECON' => 10
);

$MT = array(
  'ESPG' => 10,
  'IFGT' => 10,
  'DECG' => 30
);

$MT1 = array(
  'ORGT' => 30,
  'MRKF' => 25,
  'OGCG' => 40,
  'MATH' => 10
);

$MT2 = array(
  'DECT' => 30,
  'SGRH' => 20,
  'MKCT' => 30,
  'CDG' => 30
);

$MCW = array(
  'MATH'=>20,
  'IFCM'=> 30,
  'ANPR'=> 30,
  'DEVM'=>30,
  'SIER'=> 30
);

$MCW1 = array( 
  'ECON'=>10
);


$Sri1Coffs = array(
  ...$commun,
  ...$SRI,
  ...$SRI1
);
$Sri2Coffs = array(
  ...$commun,
  ...$SRI
);

$Mt1Coffs = array(
  ...$commun,
  ...$MT,
  ...$MT1
);

$Mt2Coffs = array(
  ...$commun,
  ...$MT,
  ...$MT2
);

$Mcw1Coffs = array(
  ...$commun,
  ...$MCW,
  ...$MCW1
);

$Mcw2Coffs = array(
  ...$commun,
  ...$MCW
);

