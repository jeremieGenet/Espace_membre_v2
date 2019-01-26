<!--******************************************************************************************************/
/*************** PAGE DE PRESENTATION DU COMPTE DE L'UTILISATEUR *************************************/
/****************************************************************************************************-->

<?php ob_start(); ?>

    <h1 class="text-center mt-4">Votre compte :</h1>

    <hr class="bg-secondary">
    
    <h2 class="text-center my-3">Bonjour <?= $_SESSION['infoUser']['username']; ?> </h2>

    

    <!-- FORMULAIRE DE CHANGEMENT DE MOT DE PASSE -->
    <form action="" method="POST">

    <div class="form-group text-center bg-warning">
        <a href="forget.php"> (J'ai oublié mon mot de passe)</a>
    </div>

    <div class="form-group">
        <label for="">Changer de mot de passe :</label>
        <input type="password" name="mdp" class="form-control" placeholder="Entrer votre nouveau mot de passe">
    </div>
    <div class="form-group">
        <label for="">Confirmer le nouveau mot de passe :</label>
        <input type="password" name="mdp2" class="form-control" placeholder="Confirmation du mot de passe">
    </div>

    <button type="submit" class="btn btn-primary ">Enregistrer les modifications</button>


    </form>

<?php 

$content = ob_get_clean();

require_once 'inc/route.php';
pathTemplate("Compte utilisateur", ""); // Permet d'initialiser toutes les variables de template.php

require 'template.php';

?>