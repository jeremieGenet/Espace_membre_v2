<!--*****************************************************************************************************/
/*************** PAGE HOME *********************************/
/***************************************************************************************************-->

<?php 


$title = "Accueil";
$style_bootstrap = "css/bootstrap.min.css";
$fontawesome_cdn = 'https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous';
$monStyle = "css/app.css";


$linkHome = "index.php";
$linkLogin = "index.php?espace_membre=login";
$linkLogout = "index.php?espace_membre=logout";
$linkRegister = "index.php?espace_membre=register";


?>

<?php ob_start(); ?>

    <h1>HOME</h1>

<?php 

$content = ob_get_clean();

/*
// Les 3 scripts suivants servent au fonctionnement de bootstrap
$JsJquery = "js/jquery.min.js";
$JsPopper = "js/popper.min.js";
$JsBootstrap = "js/bootstrap.min.js";
*/

require_once 'inc/route2.php';
//pathTemplate2("Page d'accueil"); // Permet d'initialiser toutes les variables de template.php

require 'template.php';

//echo $style_bootstrap;

?>
