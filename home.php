<?php

/******************************************************************************************************/
/*************** PAGE D'ACCUEIL' *************************************/
/****************************************************************************************************/

require 'inc/autoLoader.php'; // On inclue l'autoLoader qui s'occupe de charger nos classes

//$db = App::getDataBase(); // Connexion à la bdd (getDataBase est une méthode statique)

// On instancie la class Auth.php (qui permet la gestion de l'authentification) avec la méthode getAuth() de la classe App.php (qui se charge elle-même d'instancier les autres classe)
// et on lui applique la méthode restrict() de la classe Auth.php qui permet que s'il personne n'est connecté alors on refuse l'accès à account.php avec un message flash
//App::getAuth()->restrict(); // EMPECHE D'ALLER A CETTE PAGE

?>

<?php ob_start(); ?>

    <h1 class="text-center mt-4">PAGE HOME</h1>

    <hr class="bg-secondary">
    
    <h2 class="text-center my-3">Vous êtes à l'accueil du site</h2>

<?php

$content = ob_get_clean();

$title = "S'enregistrer";
$style_bootstrap = "css/bootstrap.min.css";
$fontawesome_cdn = 'https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous';
$monStyle = "css/app.css";

//$linkHome = "index.php";
$linkHome = "home.php";
//$linkLogin = "index.php?espace_membre=login";
$linkLogin = "login.php";
$linkLogout = "index.php?espace_membre=logout";

//$linkRegister = "index.php?espace_membre=register";
$linkRegister = "register.php";

// Les 3 scripts suivants servent au fonctionnement de bootstrap
$JsJquery = "js/jquery.min.js";
$JsPopper = "js/popper.min.js";
$JsBootstrap = "js/bootstrap.min.js";

//require_once 'inc/route.php';
//pathTemplate("Page d'enregistrement utilisateur"); // Permet d'initialiser toutes les variables de template.php
//pathTemplate2("Page d'enregistrement utilisateur"); // Permet d'initialiser toutes les variables de template.php

require 'template.php';

?>