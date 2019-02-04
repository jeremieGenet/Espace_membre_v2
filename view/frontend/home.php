<!--*********************************************************************************************/
/********************************* PAGE D'ACCUEIL *********************************************/
/********************************************************************************************-->

<?php ob_start(); ?>

    <h1 class="text-center mt-4">PAGE HOME</h1>

    <hr class="bg-secondary">
    
    <h2 class="text-center my-3">Vous êtes à l'accueil du site</h2>

<?php

$content = ob_get_clean();

require 'template.php';

?>