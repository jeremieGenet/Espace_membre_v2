<?php 

/******************************************************************************************************/
/*************** PAGE DE CONNEXION (avec checkbox et gestion cookie) *********************************/
/****************************************************************************************************/

require_once 'inc/autoLoader.php'; // Permet de charger les classe utilisées dans ce fichier

$auth = App::getAuth(); // On crée un nouvelle instance de Auth.php (gestionnaire d'identification)
$db = App::getDatabase(); // On recup la bdd
$auth->connectFromCookie($db); // Permet de se connecté à la session si il existe le cookie nommé "remember"



// Si un utilisateur est déjà connecté alors... (REDIRECTION, un utilisateur connecté n'a pas besoin de se connecté)
//if($auth->isConnected()){
if($auth->isConnected()){
    App::redirect('account.php');
}

// Vérif si le formulaire n'est pas vide
if(!empty($_POST) && !empty($_POST['username'] && !empty($_POST['mdp']))){

    // Vérification des champs remplis, puis connection de l'utilisateur
    $user = $auth->login($db, $_POST['username'], $_POST['mdp'], isset($_POST['remember']));

    // On instancie une session (pour pouvoir se servir de la méthode setFlash())
    $session = Session::getInstance();
    // Si les verifications sont ok (rappel: login retourne $user si les vérif sont ok sinon retourne false) alors...
    if($user){
        $session->setFlash('success', "Vous êtes maintenant connecté !");
        App::redirect('account.php');
    // Sinon (alors login() à retourner false) alors...
    }else{
        $session->setFlash('danger', "Identifiant ou mot de passe incorrecte !");
    }

}

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

<form action="" method="POST">

    <hr>
    <div class="form-group">
            <a href="forget.php"> (J'ai oublié mon mot de passe)</a>
    </div>
    <hr>

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