<?php
// INDICATION DE CHEMIN BRACKET : http://localhost/Cours_POO_php_Architecture_MVC/7.Exercice_MVC

/*
    ROUTEUR qui va diriger vers la page voulue (en fonction des lien de redirection des différentes pages)
    Bdd utilisée : test, et Tables utilisée : posts et comments
*/


require('controller/espace_membreController.php'); // Contient les fonctions utilisées ici

if(isset($_GET['espace_membre'])){
    
    // GESTION DE L'ENREGISTREMENT UTILISATEUR (formulaire d'enregistrement)
    if($_GET['espace_membre'] == 'register'){
        
        // Si le  formulaire n'est pas vide alors...
        if(!empty($_POST)){
            registerUser();
        }
        displayRegister(); // Affiche la page d'enregistrement
    
    // GESTION DE LA CONNEXION UTILISATEUR (formulaire de connexion)
    }elseif($_GET['espace_membre'] == 'login'){

        if(!empty($_POST)){
            loginUser();
        }
        loginUser(); // Envoie à la page pour se connecter

    // GESTION DE LA CONFIRMATION DE CREATION DE COMPTE UTILISATEUR (envoie d'un mail avec lien pour créer son compte)
    }elseif($_GET['espace_membre'] == 'confirm'){

        if(isset($_GET['id']) && isset($_GET['token'])){
            confirmUser();
        }
        // lien reçu par l'utilisateur (après son enregistrement) pour tester la confirmation de compte (id et confirmation_token récup dans la bdd de l'utilisateur)
        // POUR TESTER :
        // http://localhost/Espace_membre_v2/index.php?espace_membre=confirm&id=95&token=UoVML8iqtOnlBdSzpwcny1q2xNFOWObWBdp5lnx7ULAd0ERH1MZituOHp3Pn
        
    // GESTION DU COMPTE DE L'UTILISATEUR  (formulaire de changement de mot de passe et +++++++++++++++++++ à venir)
    }elseif($_GET['espace_membre'] == 'account'){

        if(!empty($_POST)){
            accountUser();
        }
        displayAccount();

    // GESTION DE LA REINITIALISATION DE SON MOT DE PASSE (lien 'mot de passe oublié' dans le formulaire de connexion) 
    // (envoie d'un mail avec lien qui dirige sur un formulaire de réinitialisation de son mot de passe)
    }elseif($_GET['espace_membre'] == 'reset'){

        // Si il y a les variables 'id' et 'token_reset' alors...
        if(isset($_GET['id']) && isset($_GET['token_reset'])){
            // POUR TESTER :
            // http://localhost/Espace_membre_v2/index.php?espace_membre=reset&id=95&token_reset=FirQ4Yu4yrwhlS4fgG9iZEDZzTE5qaNgDVaPgz9TeYiG7gZc26WTs2tnfkAe
            resetPasswordUser();
        }else{
            displayLogin(); // On redirige vers la page de connexion
        }
        displayResetPassword();

    // GESTION DU MOT DE PASSE OUBLIE (formulaire de demander de reset mot de passe via son adresse email)
    }elseif($_GET['espace_membre'] == 'forget'){

        if(!empty($_POST) && !empty($_POST['email'])){
            forgetPasswordUser();
        }
        displayForgetPassword();

    // GESTION DE LA DECONNEXION UTILISATEUR
    }elseif($_GET['espace_membre'] == 'logout'){
        //
        logoutUser();
    }
}else{
    // Si il n'y a pas de variable dans l'url on affiche la page d'accueil
    home();
}







