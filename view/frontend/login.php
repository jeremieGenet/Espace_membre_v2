<!--*****************************************************************************************************/
/*************** PAGE DE CONNEXION (avec checkbox et gestion cookie) *********************************/
/***************************************************************************************************-->

<?php

//require_once '../../inc/functions.php';
//logged_user();

?>

<?php ob_start(); ?>

    <h1>Se connecter</h1>

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

    <form action="index.php?espace_membre=login" method="POST">

        <div class="form-group">
            <label for="">Pseudo ou email</label>
            <input type="text" name="username" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="">Mot de passe</label>
            <input type="password" name="mdp" class="form-control">
        </div>

        <!-- PERMET LA CREATION D'UN COOKIE -->
        <!-- Lorsque le champ 'se souvenir de moi' sera coché, alors une clé nommée remember_token sera créé dans la bdd, et cette clé sera aussi stokée dans le cookie utilisateur -->
        <div class="form-group">
            <label>
                <input type="checkbox" name="remember" value="1"/> Se souvenir de moi
            </label>
        </div>
        
        <button type="submit" class="btn btn-primary">Se connecter</button>

    </form>

<?php 

$content = ob_get_clean();

$title = "Se connecter"; 
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
//pathTemplate("Page de connexion", ""); // Permet d'initialiser toutes les variables de template.php

require 'template.php';

?>

