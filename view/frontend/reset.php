<!--******************************************************************************************************/
/*************** PAGE QUI PERMET DE REINITIALISER SON MOT DE PASSE ***********************************/
/****************************************************************************************************-->

<?php ob_start(); ?>

    <h1>Réinitialiser mon mot de passe</h1>

    <!-- GESTION DES ERREUR DU FORMULAIRE -->
    <?php if(!empty($errors)): ?>
        <div class="alert alert-danger">
            <p>Vous n'avez pas rempli le formulaire correctement</p>
            <ul>
                <?php foreach ($errors as $error):?>
                    <li> <?= $error; ?> </li>   
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="" method="POST">
        
        <div class="form-group">
            <label for="">Mot de passe</label>
            <input type="password" name="mdp" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Confirmation du mot de passe</label>
            <input type="password" name="mdp2" class="form-control">
        </div>
        

        <button type="submit" class="btn btn-primary">Réinitialiser le mot de passe</button>


    </form>

<?php 

$content = ob_get_clean();

require_once '../../inc/route.php';
pathTemplate("Page de réinitialisation de mot de passe", "../../"); // Permet d'initialiser toutes les variables de template.php

require 'template.php';

?>