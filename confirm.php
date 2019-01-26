<?php

/******************************************************************************************************/
/*************** PAGE DE PRESENTATION DU COMPTE DE L'UTILISATEUR *************************************/
/****************************************************************************************************/

require 'inc/autoLoader.php'; // On inclue l'autoLoader qui s'occupe de charger nos classes

//$db = App::getDataBase(); // Connexion à la bdd (getDataBase est une méthode statique)

// On instancie la class Auth.php (qui permet la gestion de l'authentification) avec la méthode getAuth() de la classe App.php (qui se charge elle-même d'instancier les autres classe)
// et on lui applique la méthode restrict() de la classe Auth.php qui permet que s'il personne n'est connecté alors on refuse l'accès à account.php avec un message flash
App::getAuth()->restrict();


// VERIFICATIONS LORS DE LA SOUMISSION DU FORMULAIRE
if(!empty($_POST)){
    // Si les 2 mots de passes sont différents (le nouveau et sa confirmation) alors...
    if(empty($_POST['mdp'])){

        $_SESSION['flash']['warning'] = "Il faut remplir le mot de passe !";
    }elseif($_POST['mdp'] != $_POST['mdp2']){
    
        $_SESSION['flash']['danger'] = "Les mots de passes ne correspondent pas !";
    // Sinon on fait la modif dans la bdd
    }else{
        $user_id = $_SESSION['infoUser']->id; // On récup l'id de l'utilisateur connecté
        $mdp = password_hash($_POST['mdp'], PASSWORD_BCRYPT); // On hash le nouveau mot de passe
        require_once 'inc/db.php';
        $req = $pdo->prepare('UPDATE users SET mdp = ? WHERE id = ?');
        $req->execute([$mdp, $user_id]);

        $_SESSION['flash']['success'] = "votre mot de pase à bien été mis à jour !";
    }

}
// var_dump($_SESSION) //Affiche le contenu de $_SESSION

?>

<?php ob_start(); ?>

    <h1 class="text-center mt-4">Votre compte :</h1>

    <hr class="bg-secondary">
    
    <h2 class="text-center my-3">Bonjour <?= $_SESSION['infoUser']->username; ?> </h2>

    <!-- FORMULAIRE DE CHANGEMENT DE MOT DE PASSE -->
    <form action="" method="POST">

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