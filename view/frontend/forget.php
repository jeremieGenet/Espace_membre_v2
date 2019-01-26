<!--******************************************************************************************************/
/**** PAGE QUI PERMET DE FAIT UNE DEMANDE DE MOT DE PASSE OUBLIE (envoie d'un email, avec token) ********/
/****************************************************************************************************-->

<?php ob_start(); ?>

    <h1>Mot de passe oublié</h1>

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

    <!-- FORMULAIRE DE RECUPERATION DE MOT DE PASSE -->
    <form action="" method="POST">

        <div class="form-group">
            <label for="">Email</label>
            <input type="email" name="email" class="form-control">
        </div>
        
        <button type="submit" class="btn btn-primary">Récupérer mon mot de passe</button>


    </form>

<?php 

$content = ob_get_clean();

require_once '../../inc/route.php';
pathTemplate("Page de récupération mot de passe", "../../"); // Permet d'initialiser toutes les variables de template.php

require 'template.php';

?>