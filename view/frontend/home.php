<?php

/******************************************************************************************************/
/*************** PAGE D'ACCUEIL' *************************************/
/****************************************************************************************************/

require_once 'inc/autoLoader.php'; // Permet de charger les classe utilisées dans ce dossier

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

require 'template.php';

?>