<?php
include '../sources/abreviations.php';
include '../sources/Matieres.php';
?>
<div id="Techniques">

    <h4 class="red">Pour la filiere SRI: </h4>
    <?php foreach ($SRI as $mat => $cof) {
        if ($mat != "MATH") { ?>
            <div class="suggestion">
                <label class="suggestion__h" for="<?php echo $mat ?>"><?php echo Data::getAbreviate($mat, $abreviations); ?></label class="suggestion__h">
                <input type="checkbox" name="<?php echo $mat ?>" id="<?php echo $mat ?>" value="<?php echo $mat ?>">
            </div>
        <?php }
    }
    foreach ($SRI1 as $mat => $cof) {
        if ($mat != "ECON") { ?>
            <div class="suggestion">
                <label class="suggestion__h" for="<?php echo $mat ?>"><?php echo Data::getAbreviate($mat, $abreviations); ?></label class="suggestion__h">
                <input type="checkbox" name="<?php echo $mat ?>" id="<?php echo $mat ?>" value="<?php echo $mat ?>">
            </div>
        <?php }
    }?>

    <h4 class="red">Pour la filiere MT: </h4>
    <?php foreach ($MT as $mat => $cof) {
        if ($mat != "ESPG") { ?>
            <div class="suggestion">
                <label class="suggestion__h" for="<?php echo $mat ?>"><?php echo Data::getAbreviate($mat, $abreviations); ?></label class="suggestion__h">
                <input type="checkbox" name="<?php echo $mat ?>" id="<?php echo $mat ?>" value="<?php echo $mat ?>">
            </div>
        <?php }
    }
    foreach ($MT1 as $mat => $cof) {
        if ($mat != "MATH") { ?>
            <div class="suggestion">
                <label class="suggestion__h" for="<?php echo $mat ?>"><?php echo Data::getAbreviate($mat, $abreviations); ?></label class="suggestion__h">
                <input type="checkbox" name="<?php echo $mat ?>" id="<?php echo $mat ?>" value="<?php echo $mat ?>">
            </div>
        <?php }
    }
    foreach ($MT2 as $mat => $cof) { ?>
        <div class="suggestion">
            <label class="suggestion__h" for="<?php echo $mat ?>"><?php echo Data::getAbreviate($mat, $abreviations); ?></label class="suggestion__h">
            <input type="checkbox" name="<?php echo $mat ?>" id="<?php echo $mat ?>" value="<?php echo $mat ?>">
        </div>
    <?php } ?>
    <h4 class="red">Pour la filiere MCW: </h4>
    <?php foreach ($MCW as $mat => $cof) {
        if ($mat != "MATH" &&  $mat != 'ECON') { ?>
            <div class="suggestion">
                <label class="suggestion__h" for="<?php echo $mat ?>"><?php echo Data::getAbreviate($mat, $abreviations); ?></label class="suggestion__h">
                <input type="checkbox" name="<?php echo $mat?>" id="<?php echo $mat ?>" value="<?php echo $mat ?>">
            </div>
    <?php }
    } ?>


</div>