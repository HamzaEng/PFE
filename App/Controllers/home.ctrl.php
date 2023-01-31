<?php 

/* une fonction qui permet d'afficher une fichier pdf d'un dossier donné qui contient une seul fichier  */

function getPdfFile($folder){
    $files = glob($folder."/*.pdf");
    array_push($files,...glob($folder."/*.PDF")); // en cas d'une extension pdf en majiscule
    if(!empty($files)){
        echo $files[0];
}

}


?>