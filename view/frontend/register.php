<!--****************************************************************************************************************/
/********* PAGE D'ENREGISTREMENT D'UN NOUVEAU MEMBRE (avec envoie de mail pour confirmation de compte) *********/
/**************************************************************************************************************-->

<?php ob_start(); ?>

    <h1>S'inscrire</h1>

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

    <!-- action="index.php?action=editComment&amp;id=  */*/*= $comment['id'] ?>" -->


    <form action="index.php?espace_membre=register"method="POST">

        <div class="form-group">
            <label for="">Pseudo</label>
            <input type="text" name="username" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Email</label>
            <input type="email" name="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Mot de passe</label>
            <input type="password" name="mdp" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Confirmation de mot de passe</label>
            <input type="password" name="mdp2" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">S'inscrire</button>

    </form>

<?php 

$content = ob_get_clean();

$title = "S'enregistrer"; 
$style_bootstrap = "css/bootstrap.min.css";
$fontawesome_cdn = 'https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous';
$monStyle = "css/app.css";

$linkHome = "index.php";
$linkLogin = "index.php?espace_membre=login";
$linkLogout = "index.php?espace_membre=logout";
$linkRegister = "index.php?espace_membre=register";

// Les 3 scripts suivants servent au fonctionnement de bootstrap
$JsJquery = "js/jquery.min.js";
$JsPopper = "js/popper.min.js";
$JsBootstrap = "js/bootstrap.min.js";

//require_once 'inc/route.php';
//pathTemplate("Page d'enregistrement utilisateur"); // Permet d'initialiser toutes les variables de template.php
//pathTemplate2("Page d'enregistrement utilisateur"); // Permet d'initialiser toutes les variables de template.php

require 'template.php';

?>