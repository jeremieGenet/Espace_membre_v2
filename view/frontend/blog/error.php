<!-- Ce fichier est invoqué par le fichier index.php dans le bloc catch (bloc qui récupère les exceptions) -->

<!-- VUE DES MESSAGES D'ERREURS -->

<?php $title = 'Vue des erreurs'; ?>

<?php ob_start(); ?>
<div class="error">
    
    <?php
        echo $errorMessage;
    ?>
    
</div>
<?php 

$content = ob_get_clean(); 

require 'view/frontend/template.php';

?>
