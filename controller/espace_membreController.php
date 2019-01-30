<?php
/*
    FICHIER CONTROLLER qui contient les fonctions utiles au fichier index.php
    Fichier appelé par le routeur (index.php)
*/

// On déclare nos classes dans leurs namespace
use jeremie\Autoloader;
use jeremie\Path;
use jeremie\Session;
use jeremie\App;
use jeremie\Validator;
use jeremie\NumberManager;



// On charge est on appel l'autoloader (qui va charger les classes utilisées)
require 'class/Autoloader.php';
Autoloader::register();


// On crée une nouvelle session
Session::getInstance();


// Renvoie la page d'accueil
function home(){
    $path = new Path('Accueil'); // On instancie Path.php avec en param le titre du template (balise title dynamique)
    require('view/frontend/home.php'); // On récup la page d'accueil
}

// Affiche le formulaire d'enregistrement d'un nouvel utilisateur
function displayRegister(){
    $path = new Path("S'enregister"); // On instancie Path.php avec en param le titre du template (balise title dynamique)
    require('view/frontend/register.php');
}

// Gère l'enregistrement d'un utilisateur
function registerUser(){
    
    //require_once 'inc/autoLoader.php'; // Permet de charger les classe utilisées dans ce dossier

    $db = App::getDataBase(); // Connexion à la bdd (getDataBase est une méthode statique)

    // S'il n'y a pas d'utilisateur connecté alors...
    if(!isset($_SESSION['infoUser'])){

        // VERIFICATIONS LORS DE LA SOUMISSION DU FORMULAIRE
        //if(!empty($_POST)){
            $errors = []; // Tableau qui contiendra les différentes erreurs

            // VERIFICATION DU CHAMP USERNAME
            $validator = new Validator($_POST);
            $validator->isFormat('username', "Votre mot de passe ne peut contenir que des lettres, des chiffres ou des signes de type underscore");
            // Si il n'y a pas d'erreur (isValid() verifie si le tableau des erreur est vide) alors...
            if($validator->isValid()){
                $validator->isUnique('username', $db, 'users', "Ce pseudo est déjà pris !");
            }

            // VERIFICATION DU CHAMP EMAIL
            $validator->isEmail('email', "Votre adresse email n'est pas valide !");
            // Si il n'y a pas d'erreur (isValid() verifie si le tableau des erreur est vide) alors...
            if($validator->isValid()){
                $validator->isUnique('email', $db, 'users', "Cette adresse email est déjà utilisée pour un autre compte !");
            }
            
            // VERIFICATION DU MOT DE PASSE
            $validator->isConfirmed('mdp', "Vous n'avez pas entrer de mot de passe !", "Votre mot de passe doit être le même que votre confirmation de mot de passe !");

            // INSERTION DANS LA BDD DU FORMULAIRE
            // Si il n'y a pas d'erreur (isValid() vérifie si le tableau des erreur est vide) alors...
            if($validator->isValid()){

                // On crée un objet d'authentification (via la class App.php qui initialise un objet de la classe Auth.php),
                // puis avec la méthode register(), on sécurise les champs du formulaire, Insertion dans la bdd, envoie d'un email de confirmation de création de compte
                App::getAuth()->register($db, $_POST['username'], $_POST['mdp'], $_POST['email']); // en param le contenu des champs du formulaire

                // On crée une instance de session (soit un session_start()) dans laquelle on stock un message flash
                Session::getInstance()->setFlash('success', 'Un email de confirmation vous a été envoyé pour valider votre compte !');

                /*
                echo 'on arrete le script';
                //var_dump(Session::setFlash());
                var_dump($_SESSION);
                die();
                */

                App::redirect('index.php?espace_membre=login'); // On redirige vers la page de connexion et on arrête le script (exit())
                
            }else{
                // On stock les erreurs dans le tableau $errors (déclaré plus haut)
                $errors = $validator->getErrors();
            }

        //}
    // Sinon qqun est connecté et alors...
    }else{
        $_SESSION['flash']['warning'] = 'Vous êtes déjà connecté !';
        header('location: index.php?espace_membre=account'); // On redirige vers le compte utilisateur
    }
    //require('view/frontend/register.php');
    
}

// Affiche le formulaire de connexion utilisateur
function displayLogin(){
    $path = new Path("Se connecter"); // On instancie Path.php avec en param le titre du template (balise title dynamique)
    require('view/frontend/login.php');
}

// Gère la connexion et renvoie la page de connexion
function loginUser(){

    $path = new Path("Se connecter"); // On instancie Path.php avec en param le titre du template (balise title dynamique)

    $auth = App::getAuth(); // On crée un nouvelle instance de Auth.php (gestionnaire d'identification)
    $db = App::getDatabase(); // On recup la bdd
    $auth->connectFromCookie($db); // Permet de se connecté à la session si il existe le cookie nommé "remember"

    // Si un utilisateur est déjà connecté alors... (REDIRECTION, un utilisateur connecté n'a pas besoin de se connecté)
    if($auth->isConnected()){
        App::redirect('index.php?espace_membre=account');
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
            App::redirect('index.php?espace_membre=account');
        // Sinon (alors login() à retourner false) alors...
        }else{
            $session->setFlash('danger', "Identifiant ou mot de passe incorrecte !");
        }

    }
    require('view/frontend/login.php');

}

// Gère la confirmation de compte de l'utilisateur
function confirmUser(){
    
    /**********************************************************************************************************************************************/
    /****** TRAITEMENT DE LA CONFIRMATION DE CREATION DE COMPTE DE L'UTILISATEUR (mail reçu lors de la création de son compte) ***********/
    /********************************************************************************************************************************************/
    /*
                    
        (l'utilisateur doit avoir reçu un mail dans lequel un lien avec son id et son token renvoi ici à confirm.php, et ce lien comporte donc l'id et le token de l'utilisateur

        OBJECTIF DU TRAITEMENT: récup l'id, et le token de l'utilisateur (qui veut confirmer la création de son compte),
            et comparer le token à celui qui est dans la bdd, si c'est le cas on connecte l'utilisateur et on le diriger vers son compte.
    
            POUR TESTER ENTRER DANS L'url : http://localhost/Espace_Membre3/index.php?espace_membre=confirm&id=91&token=6Z5SsFtR7BIb9XNNBm9Odz35aoRKWH8SvV2EpoiqFrE0LX9Uopo9A5ceIAnN
            (id=13 pour l'utilisateur nommé 'tingle' et comme confirmation_token: P2mZuDDkcYnoBG6bvABmg1xE95vEmg5jYCJMSSgHk3H6lMW5nXAcZSlqaCdy )

            http://localhost/Espace_membre_v2/index.php?espace_membre=confirm&id=97&token=w6jwNcF76mlD4aiwRJ6PhGnfAzBSkXapQQktkumGRyMRcHiMVQ6KuvgnNYbu
            
    */


    $db = App::getDataBase(); // On récup la bdd


    // App::getAuth() permet de  créer un objet d'authentification (via la class App.php qui initialise un objet de la classe Auth.php)
    // Si App::getAuth()->confirm() vaut true (c'est que le confirmation_token a été trouvé dans la bdd) et que le $token de l'url est le même que le confirmation_token alors...
    if(App::getAuth()->confirm($db, $_GET['id'], $_GET['token'], Session::getInstance())){ // Le 4e param est une instance le session (parce que la méthode confirm() a besoin d'envoyer des infos dans la session)
        //$_SESSION['flash']['success'] = "Votre compte a bien été validé !";
        Session::getInstance()->setFlash('success', "Votre compte a bien été validé !");
        App::redirect('index.php?espace_membre=account'); // Redirection vers le fichier account.php
    // Sinon c'est que le token n'est pas le même, ou qu'il a déjà été utilisé (on le met à null dan la requête un peu plus haut)
    }else{
        //$_SESSION['flash']['danger'] = "Ce token n'est plus valide !"; // On stock un message d'erreur directement dans la session (on lui donne la classe bootstrap pour la couleur)
        Session::getInstance()->setFlash('danger', "Ce token n'est plus valide !");
        App::redirect('index.php?espace_membre=login'); // Redirection vers le fichier login.php
    }

}

function displayAccount(){
    App::getAuth()->restrict(); // Permet de ne pas authoriser l'accès à account si personne n'est connecté
    $path = new Path("Mon compte"); // On instancie Path.php avec en param le titre du template (balise title dynamique)
    require('view/frontend/account.php');
}

// Affiche la page de compte de l'utilisateur connecté et lui permet d'y modifier son mot de passe
function accountUser(){
    
    //require_once 'inc/autoLoader.php'; // Permet de charger les classe utilisées dans ce dossier

    $db = App::getDataBase(); // Connexion à la bdd (getDataBase est une méthode statique) et permet l'utilisation de la méthode queryClass() quant on fera l'update du mdp

    // On instancie la class Auth.php (qui permet la gestion de l'authentification) avec la méthode getAuth() de la classe App.php (qui se charge elle-même d'instancier les autres classe)
    // et on lui applique la méthode restrict() de la classe Auth.php qui permet que s'il personne n'est connecté alors on refuse l'accès à account.php avec un message flash

    /************** BUG (MEME NON CONNECTE ON PEUT ARRIVER SUR LA PAGE ACCOUNT *******************************/
    //App::getAuth()->restrict();

    
    // VERIFICATIONS LORS DE LA SOUMISSION DU FORMULAIRE
    //if(!empty($_POST)){
    
        if(empty($_POST['mdp'])){

            $_SESSION['flash']['warning'] = "Il faut remplir le mot de passe !";
        // Si les 2 mots de passes sont différents (le nouveau et sa confirmation) alors...
        }elseif($_POST['mdp'] != $_POST['mdp2']){
            $_SESSION['flash']['danger'] = "Les mots de passes ne correspondent pas !";
            displayAccount(); // On affiche la page account

        // Sinon on fait la modif dans la bdd
        }else{
            $user_id = $_SESSION['infoUser']->id; // On récup l'id de l'utilisateur connecté
            $mdp = password_hash($_POST['mdp'], PASSWORD_BCRYPT); // On hash le nouveau mot de passe
            // UPDATE du mot de passe dans la bdd
            $req = $db->queryClass('UPDATE users SET mdp = ? WHERE id = ?', [$mdp, $user_id]);

            $_SESSION['flash']['success'] = "votre mot de passe à bien été mis à jour !";
            displayAccount(); // On affiche la page account
        }
    
    //}
    //require('view/frontend/account.php');
    

}

// Déconnecte un utilisateur connecté
function logoutUser(){
    //require_once 'inc/autoLoader.php'; // Permet de charger les classe utilisées dans ce dossier

    App::getAuth()->logout();
    Session::getInstance()->setFlash('success', "Vous êtes maintenant déconnecté !");
    App::redirect('index.php?espace_membre=login');

    // Destruction du cookie (qui est créé lorsque l'utilisateur coche la case "se souvenir de moi" lors de la connexion)
    setcookie('remember', NULL, -1); // parm 1 = récup du nom du cookie, param2= valeur du cookie que l'on met à NULL, param3= une date d'expiration négative (pour qu'il disparaisse)

    // On supprime de la session tout ce qui concerne l'utilisateur
    unset($_SESSION['infoUser']);
}


function displayForgetPassword(){
    $path = new Path("Mot de passe oublié ?"); // On instancie Path.php avec en param le titre du template (balise title dynamique)
    require('view/frontend/forget.php');
}

// Permet de faire une demande de mot de passe oublié (envoie d'email avec token)
function forgetPasswordUser(){
    
    //require_once 'inc/autoLoader.php'; // Permet de charger les classe utilisées dans ce dossier

    // Si des données ont été postées et que l'email n'est pas vide alors...
    //if(!empty($_POST) && !empty($_POST['email'])){

        $auth = App::getAuth(); // On crée un nouvelle instance de Auth.php (gestionnaire d'identification)
        $db = App::getDatabase(); // On recup la bdd
        $session = Session::getInstance(); // On créé une instance de Session.php pour se servir de setFlash() un peu après

        // Si le reset du password est ok (qu'il ne retourne pas false) alors...
        if($auth->resetPassword($db, $_POST['email'])){
            $session->setFlash('success', "Les instructions du rappel de mot de passe vous ont été envoyées par email ! Consultez votre boite mail.");
            App::redirect('index.php?espace_membre=login');
        }else{
            $session->setFlash('danger', "Aucun compte ne correspond à cette adresse !");
        }

    //}

}


function displayResetPassword(){
    $path = new Path("Réinitialiser son mot de passe ?"); // On instancie Path.php avec en param le titre du template (balise title dynamique)
    require('view/frontend/reset.php');
}

// Permet de réinitialiser le mot de passe d'un utilisateur connecté
function resetPasswordUser(){

    // Si il y a une variable id et token dans l'url alors...
    //if(isset($_GET['id']) && isset($_GET['token_token'])){

        $auth = App::getAuth();
        $db = App::getDatabase();

        
        // TRAITEMENT DU FORMULAIRE DE NOUVEAU MOT DE PASSE 
        if(!empty($_POST)){

            // checkResetToken() retourne un utilisateur (tout les infos d'un utilisateur) si la req est ok sinon retourne false
            $user = $auth->checkResetToken($db, $_GET['id'], $_GET['token_reset']);

            // Si la req à bien fonctionnée (c'est qu'il y a l'id et le reset_token dans l'url et donc que l'utilisateur à cliqué sur le lien qu'il a reçu par email) alors...
            if($user){
            
                // Si le mot de passe est différent de la confirmation alors...
                if($_POST['mdp'] != $_POST['mdp2']){
                    Session::getInstance()->setFlash('danger', "Votre mot de passe doit être le même que la confirmation de mot de passe !");
                // Sinon on hash, insére le nouveau mot de passe (puis connexion et redirection)
                }else{
                    $mdp = NumberManager::hashPassword($_POST['mdp']);
                    // On insère le nouveau mot de passe et on met à null les reset_token et reset_at (qui n'ont plus d'utilités)
                    $db->queryClass('UPDATE users SET mdp = ?, reset_at = NULL, reset_token = NULL WHERE id = ?', [$mdp, $_GET['id']]);

                    Session::getInstance()->setFlash('success', "Votre mot de passe a bien été modifié !");
                    $auth->connectUser($user); // On connect l'utilisateur
                    App::redirect('index.php?espace_membre=account');

                }
            }else{
                Session::getInstance()->setFlash('warning', "Ce token n'est pas valide !");
                App::redirect('index.php?espace_membre=login');
            }    
        }
        

    //}else{
        //App::redirect('index.php?espace_membre=login');
    //}

}



