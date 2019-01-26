<?php

// Permet d'initialiser le template de base
function pathTemplate($titleView, $navFolder = "../../"){

    global $title, $style_bootstrap, $fontawesome_cdn, $monStyle, $linkHome, $linkLogin, $linkLogout, $linkRegister, $JsJquery, $JsPopper, $JsBootstrap;

    $title = $titleView; 
    $style_bootstrap = $navFolder . "css/bootstrap.min.css";
    $fontawesome_cdn = 'https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous';
    $monStyle = $navFolder . "css/app.css";

    $linkHome = $navFolder . "index.php";
    $linkLogin = $navFolder . "index.php?espace_membre=login";
    $linkLogout = $navFolder . "index.php?espace_membre=logout";
    $linkRegister = $navFolder . "index.php?espace_membre=register";

    // Les 3 scripts suivants servent au fonctionnement de bootstrap
    $JsJquery = $navFolder . "js/jquery.min.js";
    $JsPopper = $navFolder . "js/popper.min.js";
    $JsBootstrap = $navFolder . "js/bootstrap.min.js";

}

